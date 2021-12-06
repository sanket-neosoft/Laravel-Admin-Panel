<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    public function login(Request $req)
    {
        $validate = $req->validate([
            'email' => 'required|email',
            'password' => 'required|max:16|min:8'
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Invalid email address.',
            'password.required' => 'Please enter password.',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must not be greater than 16 characters.',
        ]);
        if ($validate) {
            $user = UserAccount::where('email', $req->email)->get();
            // return !empty($user);
            if (count($user) > 0) {
                if (Hash::check($req->password, $user[0]->password)) {
                    $user = UserAccount::where('email', $req->email)->get();
                    $req->session()->put('user', $user);
                    return redirect('/dashboard');
                } else {
                    return back()->with('errMsg', 'Please check password.');
                }
            } else {
                return back()->with('errMsg', 'Invalid login credentials');
            }
        }
    }

    public function register(Request $req)
    {
        $validate = $req->validate([
            'email' => 'required|email|unique:user_accounts,email',
            'username' => 'required|regex:/^[a-z0-9_]+$/|min:5|max:16|unique:user_accounts,uname',
            'password' => 'required|max:16|min:8|confirmed',
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'password_confirmation' => 'required',
            'age' => 'required',
            'city' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Invalid email address.',
            'username.required' => 'Please enter username',
            'username.regex' => "Invalid username. Only small alphabets, numbers and '_' are allowed",
            'username.min' => 'Password must be at least 5 characters',
            'username.max' => 'Password cannot be greater than 16 characters',
            'password.required' => 'Please enter password.',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password cannot be greater than 16 characters.',
            'password.confirmed' => 'Password does\'nt match.',
            'password_confirmation.required' => 'Please re-enter password.',
            'name.required' => 'Please enter your name.',
            'name.regex' => 'Only characters and white space are allowed.',
            'age.required' => 'Please enter your age.',
            'city.required' => 'Please enter your city.',
            'image.required' => 'Please select image.',
            'image.mimes' => 'Only png, jpg, jpeg files can be uploaded.'
        ]);


        if ($validate) {
            $file = $req->file('image');
            $fname = "Image-" . rand() . "-" . time() . "." . $file->extension();
            $dest = public_path('/uploads');

            if ($file->move($dest, $fname)) {
                $user = new UserAccount;
                $user->email = $req->email;
                $user->password = Hash::make($req->password);
                $user->uname = $req->username;
                $user->name = $req->name;
                $user->age = $req->age;
                $user->city = $req->city;
                $user->image = $fname;
                if ($user->save()) {
                    return redirect('/');
                } else {
                    $path = public_path() . "uploads/" . $fname;
                    unlink($path);
                    return back()->with('errMsg', 'Registration Error');
                }
            } else {
                return back()->with('errMsg', 'Uploading Error');
            }
        }
    }

    public function dashboard()
    {
        $categories = Category::all();
        return view('pages.dashboard', ['categories' => $categories]);
    }

    public function add_category(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'mimes:png,jpg|required',
        ]);
        if ($validate) {
            $file = $req->file('image');
            $fname = "cat-" .  time() . rand() . "." . $file->extension();
            if ($file->move(public_path('categories'), $fname)) {
                $cat = new Category();
                $cat->name = $req->name;
                $cat->description = $req->desc;
                $cat->image = $fname;
                if ($cat->save()) {
                    return redirect('/dashboard');
                } else {
                    return back()->with('errMsg', 'Some error occured');
                }
            } else {
                return back()->with('errMsg', 'Image upload error.');
            }
        }
    }

    public function get_category($id)
    {
        $category = Category::where('id', $id)->first();
        return $category;
    }

    public function edit_category(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required',
            'desc' => 'required',
        ]);
        if ($validate) {
            $category = Category::where('id', $req->id)->first();
            $category->name = $req->name;
            $category->description = $req->desc;
            if ($req->file('image')) {
                $req->file('image')->move(public_path('categories'), $category->image);
            }
            $category->save();
            return true;
        }
    }

    public function delete_category(Request $req)
    {
        $products = Product::where('c_id', $req->cid);
        if ($products) {
            foreach ($products->get() as $product) {
                unlink(public_path('products/') . $product->image);
            }
        }
        $cat = Category::where('id', $req->cid)->first();
        $imgpath = public_path('categories') . "/" . $cat->image;
        $category = Category::find($req->cid);
        if ($category->delete()) {
            unlink($imgpath);
            return true;
        } else {
            return false;
        }
    }

    public function change_pass()
    {
        if (session('user')) {
            return view('pages.changepass');
        } else {
            // return redirect('/');
        }
    }

    public function chng_pass(Request $req)
    {
        $validate = $req->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|max:16|min:8',
            'cnfpassword' => 'required'
        ]);
        if ($validate) {
            $user = UserAccount::find(session('user')[0]->id);
            if (Hash::check($req->oldpassword, $user->password)) {
                if ($req->newpassword === $req->cnfpassword) {
                    $user->password = Hash::make($req->newpassword);
                    $user->save();
                    return back()->with('success', 'Password updated successfully.');
                } else {
                    return back()->with('status', 'Confirm Password doesn\'t match.');
                }
            } else {
                return back()->with('status', "Old password doesn't match");
            }
        }
    }

    public function change_profile(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'age' => 'required',
            'city' => 'required',
        ], [
            'name.required' => 'Please enter your name.',
            'name.regex' => 'Only characters and white space are allowed.',
            'age.required' => 'Please enter your age.',
            'city.required' => 'Please enter your city.',
        ]);

        if ($validate) {
            $user = UserAccount::find(session('user')[0]->id);
            $user->name = $req->name;
            session('user')[0]->name = $req->name;
            $user->age = $req->age;
            session('user')[0]->age = $req->age;
            $user->city = $req->city;
            session('user')[0]->city = $req->city;
            $user->save();
            return back()->with('success', 'Profile updated successfully.');
        } else {
            return back()->with('errMsg', 'Profile update failed.');
        }
    }

    public function change_image(Request $req)
    {
        $validate = $req->validate([
            'image' => 'required|mimes:png,jpg,jpeg'
        ], [
            'image.required' => 'Please select image.',
            'image.mimes' => 'Only png, jpg, jpeg files can be uploaded.'
        ]);
        if ($validate) {
            $file = $req->file('image');
            if ($file->move(public_path('/uploads'), session('user')[0]->image)) {
                return back()->with('success', 'Profile picture updated successfully.');
            } else {
                return back()->with('errMsg', 'Profile picture update failed');
            }
        }
    }

    public function logout()
    {
        session()->forget('user');
        return redirect('/');
    }

    public function product()
    {
        $cat = Category::all();
        return view('pages.addproduct', ['cat' => $cat]);
    }

    public function products(Request $req)
    {
        $cat = Category::all();
        $products = Product::with('Category')->get();
        return view('pages.products', ['products' => $products, 'cat' => $cat]);
    }

    public function get_product($id)
    {
        $product = Product::where('id', $id)->first();
        return $product;
    }

    public function add_product(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required|unique:products,name',
            'category' => 'required',
            'image' => 'required|mimes:png,jpg',
            'price' => 'required',
            'quantity' => 'required',
            'features' => 'required',
        ]);

        if ($validate) {
            $file = $req->file('image');
            $fname = 'product' . time() . rand() . '.' . $file->extension();
            if ($file->move(public_path('products'), $fname)) {
                $product = new Product();
                $product->name = $req->name;
                $product->c_id = $req->category;
                $product->price = $req->price;
                $product->quantity = $req->quantity;
                $product->features = $req->features;
                $product->image = $fname;
                if ($product->save()) {
                    return redirect('/dashboard/products');
                } else {
                    $path = public_path() . "products/" . $fname;
                    unlink($path);
                    return back()->with('errMsg', 'Some error occured while adding product.');
                }
            } else {
                return back()->with('errMsg', 'Error While uploading image');
            }
        }
    }

    public function edit_product(Request $req)
    {
        // $validate = $req->validate([
        //     'name' => 'required',
        //     'features' => 'required',
        //     'price' => 'required',
        //     'quantity' => 'required',
        // ]);
        $product = Product::where('id', $req->id)->first();
        $product->name = $req->name;
        $product->price = $req->price;
        $product->c_id = $req->category;
        $product->quantity = $req->quantity;
        $product->features = $req->features;
        if ($req->file('image')) {
            $req->file('image')->move(public_path('products'), $product->image);
        }
        $product->save();
        return true;
    }

    public function delete_product(Request $req)
    {
        $product = Product::where('id', $req->pid);
        if ($product) {
            unlink(public_path('products/') . $product->first()->image);
            $product->delete();
            return true;
        } else {
            return false;
        }
    }
}
