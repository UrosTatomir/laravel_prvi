<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponseRedirectResponseredirect;
// use Illuminate\View\Middleware\ShareErrorsFromSessionweb;
// use Illuminate\Support\Facades\Validator;
class MyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showInsertDriver(){
       return view('insert'); 
    }
    public function insertDriver( Request $request){
        $name=$request->input('name');
        $surname=$request->input('surname');
        $age=$request->input('age');
        // dd($name, $surname, $age);

        $name = $request->validate([
            'name' => 'required|string:get|max:255',
            
        ]);
        $surname = $request->validate([
            'surname' => 'required|string:get|max:255',
            
        ]);
        $age = $request->validate([
            'age' => 'required|int|min:21|max:70',  //ogranicenje starosti min 21 godina
        ]);
         //sql insert u bazu 
        
        DB::table('drivers')->insert(
            array(
                'name'=>$request->input('name'),
                'surname'=>$request->input('surname'),
                'age'=>$request->input('age'))
                 );
        
        // return view('index')->withSuccess( 'Records saved Successfully');
        return Redirect::to('alldrivers');
        //redirect funkcijom vracamo se na route pa na index stranu sa tim da se ne ponavljaju ponovni inserti u bazu
    }
    public function showInsertCar(){
        return view('insert_car');
    }
    public function insertCar(Request $request){
        $brand=$request->input('brand');
        $model=$request->input('model');
        $category=$request->input('category');
        $year_vehicle=$request->input('year_vehicle');
        $price=$request->input('price');

        $brand=$request->validate([
            'brand'=>'required|string:get|max:255',
        ]);
        $model=$request->validate([
            'model'=>'required|string:get|max:255',
        ]);
        $category=$request->validate([
            'category'=>'required|string:get|max:255',
        ]);
        $year_vehicle=$request->validate([
            'year_vehicle'=>'required|int|min:2005',
        ]);
        $price=$request->validate([
            'price'=>'required|numeric|min:1000'
        ]);

        DB::table('vehicle')->insert(
            array(
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
                'category' => $request->input('category'),
                'year_vehicle'=>$request->input('year_vehicle'),
                'price'=>$request->input('price')
            )
        );
        return Redirect::to('allvehicle');
    }
    public function showAllVehicle(){
        return view('allvehicle');
    }
    public function showEditVehicle(Request $request){
        $id_vehicle=$request->id_vehicle; //kupljenje id_vechicle sa stranice allvehicle.blade.php
        // dd($id_vehicle);
    
        $one_vehicle=DB::table('vehicle')->where('id_vehicle',$id_vehicle)->get(); //select za izvlacenje vozila po id_vehicle
        // dd($one_vehicle);
        return view('edit_vehicle')->with('one_vehicle',$one_vehicle); //vracanje na stranu edit_vehicle sa nizom vozila po id_vehicle 
    }
    public function editVehicle(Request $request){
       $id_vehicle=$request->input('id_vehicle'); //kupljenje iz forme
       $brand=$request->input('brand');
       $model=$request->input('model');
       $category=$request->input('category');
       $year_vehicle=$request->input('year_vehicle');
       $price=$request->input('price');
       //validacija
        $brand = $request->validate([
            'brand' => 'required|string:get|max:255',
        ]);
        $model = $request->validate([
            'model' => 'required|string:get|max:255',
        ]);
        $category = $request->validate([
            'category' => 'required|string:get|max:255',
        ]);
        $year_vehicle = $request->validate([
            'year_vehicle' => 'required|int|min:2005',
        ]);
        $price = $request->validate([
            'price' => 'required|numeric|min:1000'
        ]);
        //upis u bazu
        DB::table('vehicle')
             ->where('id_vehicle',$id_vehicle)
             ->update(array(
                        'brand' => $request->input('brand'),
                        'model' => $request->input('model'),
                        'category' => $request->input('category'),
                        'year_vehicle' => $request->input('year_vehicle'),
                        'price' => $request->input('price')
                    )
        );
        //u ovom slucaju nije potrebno ponovo kupiti podatke za  vozilo iz baze jer se na stran allvehicle nalazi upit u bazu  
        // vracamo se na stranicu allvehicle i usput saljemo id_vehicle i poruku o izmeni
        return view('allvehicle')->with('id_vehicle',$id_vehicle)->withSuccess( 'Records update successfully');

    }
    public function deleteVehicle(Request $request){
    
      $id_vehicle=$request->id_vehicle;
      if(!empty($id_vehicle)){
         DB::table('vehicle')->where('id_vehicle',$id_vehicle)->delete(); 
         //vracanmo se na stranu allvehicle i saljemo id_vehicle zato jer ga kod ocekuje kod sencenja
         return view('allvehicle')->with('id_vehicle', $id_vehicle)->withSuccess('Records delete successfully');
      }
      return view('allvehicle')->with('id_vehicle', $id_vehicle)->withSuccess( 'Records not selected');
    }
    public function showAllDrivers(){
        return view('alldrivers');
    }
    public function showEditDriver(Request $request){
        $id_driver=$request->id_driver;
        if(!empty($id_driver)){
         $driver=DB::table('drivers')->where('id_driver',$id_driver)->get();
         return view('edit_driver')->with('driver',$driver);
        }
    }
    public function editDriver(Request $request){
        
        $id_driver=$request->input('id_driver');
        $name=$request->input('name');
        $surname=$request->input('surname');
        $age=$request->input('age');

        //validacija svih elemenata osim id_driver koji je hidden
        $name = $request->validate([
            'name' => 'required|string:get|max:255',

        ]);
        $surname = $request->validate([
            'surname' => 'required|string:get|max:255',

        ]);
        $age = $request->validate([
            'age' => 'required|int|min:21|max:70',  //ogranicenje starosti min 21 godina
        ]);

         DB::table('drivers')
           ->where('id_driver',$id_driver)
           ->update(array(
                'name'=> $request->input('name'),
                'surname'=> $request->input('surname'),
                'age' => $request->input('age')
                )
            );
        return view('alldrivers')->with('id_driver',$id_driver)->withSuccess('Records update successfully');
    }
    public function deleteDriver(Request $request){
        $id_driver=$request->id_driver;
        if(!empty($id_driver)){
         DB::table('drivers')->where('id_driver',$id_driver)->delete();
         return view('alldrivers')->with('id_driver',$id_driver)->withSuccess( 'Records delete successfully');
        }
        return view('alldrivers')->with('id_driver',$id_driver)->withSuccess('Records not selected');
    }
   public function showAssign(){
       return view('assign');
   }
   public function getAssign(Request $request){
      $id_vehicle=$request->input('id_vehicle');
      $id_driver=$request->input('id_driver');
    //   dd($id_vehicle,$id_driver);
    // $id_vd=DB::table('vehicledrivers')->where('id_vehicle',$id_vehicle)
    //                                 ->where('id_driver',$id_driver)
    //                                 ->get();
        // dd($id_vd);
      $id_vehicle=$request->validate(['id_vehicle'=> 'required|int:get',]);
      $id_driver=$request->validate(['id_driver' =>'required|int:get',]);

       
                DB::table('vehicledrivers')->insert(
                    array(
                        'id_vehicle' => $request->input('id_vehicle'),
                        'id_driver' => $request->input('id_driver')
                    )
                );
                return Redirect::to('assign');
        
      //moram popraviti unos da se kontrolisu dupli unosi   
   }
   public function showDriverByVehicle(){
       return view('choose_driverbyvehicle');
   }
   public function chooseDrivers(Request $request){
        $id_driver=$request->input('id_driver');

    $id_driver=$request->validate(['id_driver'=>'required|int:get',]);
    //select upit iz vise u vise
   // "SELECT vozila.*, vozaci.*,vozilavozaci.* FROM vozaci JOIN vozilavozaci ON vozaci.idvozaca=vozilavozaci.idvozaca JOIN vozila ON vozilavozaci.idvozila=vozila.idvozila WHERE vozaci.idvozaca=?";
    
    //  dd( $all_driver_by_vehicle);   
        return view('driverbyvehicles')->with('id_driver', $id_driver);
       
    
   }
    public function showVehicleByDriver(){

    return view('choose_vehiclebydriver');

   }
   public function chooseVehicles(Request $request){

       $id_vehicle=$request->input('id_vehicle');
       $id_vehicle=$request->validate(['id_vehicle'=>'required|int:get',]);
       
       // private $GETALLDRIVERSBYCAR = "SELECT vozaci.*,vozilavozaci.*,vozila.* FROM vozila JOIN vozilavozaci ON vozila.idvozila=vozilavozaci.idvozila JOIN vozaci ON vozaci.idvozaca=vozilavozaci.idvozaca WHERE vozila.idvozila=?";

       return view('vehiclebydrivers')->with('id_vehicle',$id_vehicle);
   }
  
   
} //end class Mycontroller
