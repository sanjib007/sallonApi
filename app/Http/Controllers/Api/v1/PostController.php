<?php



namespace App\Http\Controllers\Api\v1;
use App\Post;
use App\Category;
use Webpatser\Uuid\Uuid;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PostController extends Controller
{

    public function __construct()
    {

         $this->middleware('auth');
        // $this->middleware(['CheckUserOwnRequest'], ['only' => ['update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $info = Post::with('categories','user')->get();
      //  return $info;
        return $this->showAll($info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = $request->only(
            'title',
            'description',
            'cover_image'
        );

        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string|min:8',
           // 'cover_image' => 'required|image'
        ]);

        $data = $request->all();

        $file = $request->file('cover_image');
        if($file != null){
            $image = Image::make($file);
            $image->encode('jpg',50);


            $fileName = uniqid('img_').".jpg";

            $image->save(public_path('img/'.$fileName));
            $data['cover_image'] = $fileName;
        }


        $data['user_id'] = $request->user()->id;
        $post = Post::create($data);

        $category = Category::find($data['categories']);
        $post->categories()->attach($category);

        // $notifyUser= User::all()->except($request->user()->id)->pluck('device_token')->toArray();
        // $notificationInformation = [
        //     'title'=> 'Hurray!! new post created',
        //     'body' => $post->title." created by ".$request->user()->name,
        //     'type' =>'post'
        // ];
        // sendPushNotification($notifyUser,$notificationInformation);
        return $this->showOne($post);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return $this->showOne($post,200);
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
}
