## Create New Module
> Create [moduleName] Model
```
php artisan make:model [moduleName] -m
```
> Modify Migration Table on ***database/migrations/timestamp_create_moduleName_table***
> Modify ***app/Models/moduleName.php***
```
protected $fillable = [
   'title', 'description'
];
```
> Run Migration
```
php artisan migrate
```
> Create [moduleName] Controller
```
php artisan make:controller ModuleNameController
```
> Insert Code for New Controller
> Modify ***app/Models/User.php***. Ex:
```
public function posts()
{
    return $this->hasMany(Post::class);
}
```
> Modify API routes
```
Route::middleware('auth:api')->group(function () {
    Route::resource('posts', PostController::class);
})
```