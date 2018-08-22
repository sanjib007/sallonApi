<?php



namespace App\Http\Controllers\Api\v1;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;


class PostController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth:api', ['except' => ['index','show']]);
        // $this->middleware(['CheckUserOwnRequest'], ['only' => ['update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $info = Post::all();

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
            'cover_image' => 'required|image'
        ]);

        // $post = Post::create($details);
        // return $this->showOne($post,201);

        $data = $request->all();

        $file = $request->file('cover_image');
        $image = Image::make($file);
        $image->encode('jpg',50);


        $fileName = uniqid('img_').".jpg";

        $image->save(public_path('img/'.$fileName));

        $data['cover_image'] = $fileName;


        $data['user_id'] = $request->user()->id;
        $post = Post::create($data);
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
