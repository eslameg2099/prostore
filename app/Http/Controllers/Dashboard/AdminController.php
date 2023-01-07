<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Routing\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Cart;
use App\Models\CartItem;

use App\Models\Order;
use App\Models\Orderitem;
use App\Models\City;
use App\Models\UserCoupon;



use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Report;
use App\Models\Feedback;
use App\Models\Notification;


class AdminController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * AdminController constructor.
     *
     */
    public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::whereNotIn('id',[1,334])->filter()->latest()->paginate();

        return view('dashboard.accounts.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.accounts.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->allWithHashedPassword());

        $admin->setType($request->type);

        $admin->addAllMediaFromTokens();

        flash()->success(trans('admins.messages.created'));

        return redirect()->route('dashboard.admins.show', $admin);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('dashboard.accounts.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('dashboard.accounts.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\AdminRequest $request
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->allWithHashedPassword());

        $admin->setType($request->type);

        $admin->addAllMediaFromTokens();

        flash()->success(trans('admins.messages.updated'));

        return redirect()->route('dashboard.admins.show', $admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Admin $admin
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        flash()->success(trans('admins.messages.deleted'));

        return redirect()->route('dashboard.admins.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('viewAnyTrash', Admin::class);

        $admins = Admin::onlyTrashed()->paginate();

        return view('dashboard.accounts.admins.trashed', compact('admins'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function showTrashed(Admin $admin)
    {
        $this->authorize('viewTrash', $admin);

        return view('dashboard.accounts.admins.show', compact('admin'));
    }

    /**
     * Restore the trashed resource.
     *
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Admin $admin)
    {
        $this->authorize('restore', $admin);

        $admin->restore();

        flash()->success(trans('admins.messages.restored'));

        return redirect()->route('dashboard.admins.trashed');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param \App\Models\Admin $admin
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Admin $admin)
    {
        $this->authorize('forceDelete', $admin);

        $admin->forceDelete();

        flash()->success(trans('admins.messages.deleted'));

        return redirect()->route('dashboard.admins.trashed');
    }


    public function deletedata()
    {
        Cart::getQuery()->delete();
        User::whereNotIn('id', [1,333,323,334])->forceDelete();
        Orderitem::getQuery()->delete();
        Order::getQuery()->delete();
        Product::whereNotIn('id', [75,76,77,78])->forceDelete();
        Category::whereNotIn('id', [237,238,239,240,241,242])->forceDelete();
        Coupon::getQuery()->delete();
        Report::getQuery()->delete();
        Feedback::getQuery()->delete();
        Notification::getQuery()->delete();
        UserCoupon::getQuery()->delete();
        City::whereNotIn('id', [75,76,77,78])->forceDelete();
        flash()->success(trans('admins.messages.deletedata'));
        return redirect()->back();

    }
}
