<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App, Session, Common;
use Illuminate\Support\Facades\Log;
use App\Models\{
    Currency,
    Properties,
    Page,
    Settings,
    StartingCities,
    Testimonials,
    language,
    User,
    Wallet,
    SpaceType,
    PropertyType,
    Amenities,
    AmenityType,
    PropertyDates,
};


require base_path() . '/vendor/autoload.php';

class HomeController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index()
    {
        $data['starting_cities']     = StartingCities::getAll();
        $data['testimonials']        = Testimonials::getAll();
        $sessionLanguage             = Session::get('language');
        $language                    = Settings::getAll()->where('name', 'default_language')->where('type', 'general')->first();

        $languageDetails             = language::where(['id' => $language->value])->first();

        if (!($sessionLanguage)) {
            Session::pull('language');
            Session::put('language', $languageDetails->short_name);
            App::setLocale($languageDetails->short_name);
        }

        $pref = Settings::getAll();

        $prefer = [];

        if (!empty($pref)) {
            foreach ($pref as $value) {
                $prefer[$value->name] = $value->value;
            }
            Session::put($prefer);
        }
        $data['date_format'] = Settings::getAll()->firstWhere('name', 'date_format_type')->value;
        $valorDePropertiesGeneral=$this->propertiesGeneral();
        $data['properties'] =$valorDePropertiesGeneral;
        return view('home.home', $data);
    }
    

    public function phpinfo()
    {
        echo phpinfo();
    }

    public function login()
    {
        return view('home.login');
    }

    public function setSession(Request $request)
    {
        if ($request->currency) {
            Session::put('currency', $request->currency);
            $symbol = Currency::code_to_symbol($request->currency);
            Session::put('symbol', $symbol);
        } elseif ($request->language) {
            Session::put('language', $request->language);
            $name = language::name($request->language);
            Session::put('language_name', $name);
            App::setLocale($request->language);
        }
    }

    public function cancellation_policies()
    {
        return view('home.cancellation_policies');
    }

    public function staticPages(Request $request)
    {
        $pages          = Page::where(['url'=>$request->name, 'status'=>'Active']);
        if (!$pages->count()) {
            abort('404');
        }
        $pages           = $pages->first();
        $data['content'] = str_replace(['SITE_NAME', 'SITE_URL'], [siteName(), url('/')], $pages->content);
        $data['title']   = $pages->name;

        return view('home.static_pages', $data);
    }


    public function activateDebugger()
    {
      setcookie('debugger', 0);
    }

    public function walletUser(Request $request){

        $users = User::all();
        $wallet = Wallet::all();


        if (!$users->isEmpty() && $wallet->isEmpty() ) {
            foreach ($users as $key => $user) {

                Wallet::create([
                    'user_id' => $user->id,
                    'currency_id' => 1,
                    'balance' => 0,
                    'is_active' => 0
                ]);
            }
        }

        return redirect('/');

    }
    public function propertiesGeneral_Old()
    {
        $full_address = "";
        $checkin = "";
        $checkout = "";
        $guest = 1;
        $bedrooms = 1;
        $beds = "";
        $bathrooms = "";
        $property_type = "";
        $space_type = "";
        $amenities = "";
        $book_type = "";
        $map_details = "";
        $min_price = 0;
        $max_price = 10000000000;


        $property_type_val = [];
        $properties_whereIn = [];
        $space_type_val = [];


        $minLat = null;
        $maxLat = null;
        $minLong = null;
        $maxLong = null;
        


        $users_where['users.status'] = 'Active';


        $checkin = date('Y-m-d', strtotime($checkin));
        $checkout = date('Y-m-d', strtotime($checkout));

        $days = $this->helper->get_days($checkin, $checkout);
        unset($days[count($days) - 1]);
        $calendar_where['date'] = $days;
        
        $not_available_property_ids = PropertyDates::whereIn('date', $days)->where('status', 'Not available')->distinct()->pluck('property_id');


        $properties_where['properties.accommodates'] = $guest;

        $properties_where['properties.status'] = 'Listed';

        $property_approval = Settings::where('name', 'property_approval')->first()->value;
        $property_approval === 'Yes' ? ($properties_where['properties.is_verified'] = 'Approved') : '';



        if ($bedrooms) {
            $properties_where['properties.bedrooms'] = $bedrooms;
        }
        

        

        
        $currency_rate = Currency::getAll()
            ->firstWhere('code', \Session::get('currency'))
            ->rate;
        if(($minLat != null || $maxLat != null || $minLong != null || $maxLong != null) && $min_price != null && $users_where != null){
            
            $properties = Properties::with([
                'property_address',
                'property_price',
                'users'
            ])
                ->whereHas('property_address', function ($query) use ($minLat, $maxLat, $minLong, $maxLong) {
                    $query->whereRaw("latitude between $minLat and $maxLat and longitude between $minLong and $maxLong");
                })
                ->whereHas('property_price', function ($query) use ($min_price, $max_price, $currency_rate) {
                   $query->join('currency', 'currency.code', '=', 'property_price.currency_code');
                    $query->whereRaw('((price / currency.rate) * ' . $currency_rate . ') >= ' . $min_price . ' and ((price / currency.rate) * ' . $currency_rate . ') <= ' . $max_price);
                })
                ->whereHas('users', function ($query) use ($users_where) {
                    $query->where($users_where);
                })
                ->whereNotIn('id', $not_available_property_ids);
        }else if(($minLat == null || $maxLat == null || $minLong == null || $maxLong == null) && $min_price != null && $users_where != null){
            
            $properties = Properties::with([
                'property_address',
                'property_price',
                'users'
            ])
                ->whereHas('property_price', function ($query) use ($min_price, $max_price, $currency_rate) {
                    $query->join('currency', 'currency.code', '=', 'property_price.currency_code');
                    $query->whereRaw('((price / currency.rate) * ' . $currency_rate . ') >= ' . $min_price . ' and ((price / currency.rate) * ' . $currency_rate . ') <= ' . $max_price);
                })
                ->whereHas('users', function ($query) use ($users_where) {
                    $query->where($users_where);
                })
                ->whereNotIn('id', $not_available_property_ids);
        } else{
            $properties = Properties::with([
                'property_address',
                'property_price',
                'users'
            ])
                ->whereNotIn('id', $not_available_property_ids);
        }

        if ($properties_where) {
            foreach ($properties_where as $row => $value) {
                if ($row == 'properties.accommodates' || $row == 'properties.bathrooms' || $row == 'properties.bedrooms' || $row == 'properties.beds') {
                    $operator = '>=';
                } else {
                    $operator = '=';
                }

                if ($value == '') {
                    $value = 0;
                }

                $properties = $properties->where(function ($query) use ($row, $operator, $value) {
                                            $query->where($row, $operator, $value);
                                            $query->orWhereNull('properties.is_verified');
                                        });
            }
        }
        //$properties = $properties->paginate(Session::get('row_per_page'))->toJson();
        return $properties;
    }
    public function propertiesGeneral(){
        $min_price = 0;
        $max_price = 10000000000;
        
        $query = Properties::query();
        $currency_rate = Currency::getAll()
        ->firstWhere('code', \Session::get('currency'))
        ->rate;
        $query->where('status', 'Listed');
        
        $query->whereHas('property_price', function ($query) use ($min_price, $max_price, $currency_rate) {
            $query->join('currency', 'currency.code', '=', 'property_price.currency_code');
            $query->whereRaw("((price / currency.rate) * {$currency_rate}) >= {$min_price} and ((price / currency.rate) * {$currency_rate}) <= {$max_price}");
        });
        $properties = $query->get();
        return $properties; 
    }
    

}
