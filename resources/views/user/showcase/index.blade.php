@extends('user.layouts')
@section('content')
<div class="container">
    <!-- Nav tabs -->
    <ul class="nav nav-pills w-100 overflow-scroll d-flex flex-nowrap showcaseMenuCategory" id="showcaseTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link bg-dark active " id="menuAll-tab" data-bs-toggle="tab" data-bs-target="#menuAll" type="button" role="tab" aria-controls="menuAll" aria-selected="true">All</button>
        </li>
        @foreach ($menuCategories as $item)
        <li class="nav-item" role="presentation">
            <button class="nav-link bg-dark text-nowrap" id="menuCategory{{$item->id}}Tab" data-bs-toggle="tab" data-bs-target="#menuCategory{{$item->id}}TabContent" type="button" role="tab" aria-controls="menuCategory{{$item->id}}Tab" aria-selected="false">{{$item->name}}</button>
        </li>
        @endforeach
    </ul>

    <!-- Tab panes -->
    <div class="tab-content pb-3 menuCategoryContent">
        <div class="tab-pane active" id="menuAll" role="tabpanel" aria-labelledby="menuAll-tab">
            <ul class="list-group">
                @foreach ($menuCategories as $item)
                @foreach ($item->menus as $menuItem)
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <span>{{$menuItem->name}}</span>
                        <div>
                            <button class="btn btn-sm btn-icon" x-on:click="function(){
                                let item = cartItems.find(item => item.id == {{$menuItem->id}});
                                if(item && item.quantity > 0){
                                    item.quantity = item.quantity-1;
                                    cartCount = cartCount-1;
                                }
                            }"><i class="bi bi-dash-square-fill"></i></button>
                            <span x-text="cartItems.find(item => item.id == {{$menuItem->id}})?.quantity || 0"></span>
                            <button class="btn btn-sm btn-icon" x-on:click="function(){
                                let item = cartItems.find(item => item.id == {{$menuItem->id}});
                                if(!item){
                                    cartItems.push({...{{json_encode($menuItem)}}, quantity : 1});
                                }else{
                                    item.quantity = item.quantity+1;
                                }
                                cartCount = cartCount+1;
                            }"><i class="bi bi-plus-square-fill"></i></button>
                        </div>
                    </div>
                </li>
                @endforeach
                @endforeach
            </ul>
        </div>
        @foreach ($menuCategories as $item)
        <div class="tab-pane" id="menuCategory{{$item->id}}TabContent" role="tabpanel" aria-labelledby="menuCategory{{$item->id}}Tab">
            <ul class="list-group">
                @foreach ($item->menus as $menuItem)
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <span>{{$menuItem->name}}</span>
                        <div>
                            <button class="btn btn-sm btn-icon" x-on:click="function(){
                                let item = cartItems.find(item => item.id == {{$menuItem->id}});
                                if(item && item.quantity > 0){
                                    item.quantity = item.quantity-1;
                                    cartCount = cartCount-1;
                                }
                            }"><i class="bi bi-dash-square-fill"></i></button>
                            <span x-text="cartItems.find(item => item.id == {{$menuItem->id}})?.quantity || 0"></span>
                            <button class="btn btn-sm btn-icon" x-on:click="function(){
                                let item = cartItems.find(item => item.id == {{$menuItem->id}});
                                if(!item){
                                    cartItems.push({...{{json_encode($menuItem)}}, quantity : 1});
                                }else{
                                    item.quantity = item.quantity+1;
                                }
                                cartCount = cartCount+1;
                            }"><i class="bi bi-plus-square-fill"></i></button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>
<div class="position-absolute w-100 bottom-0 bg-dark d-flex justify-content-between align-items-center py-3 px-4 gap-3" style="z-index:1041">
    <span class="text-light">Total</span>
    <span class="text-info ms-auto">Rp. <span id="totalText" x-text="new Intl.NumberFormat('id-EN').format(cartItems.reduce((before, current) => before+(current.price * current.quantity), 0))">10.000,-</span></span>
    <button x-bind:class="`btn btn-sm ${cartCount > 0 ? 'btn-primary' : 'btn-secondary'}`" x-bind:disabled="!!!cartCount || checkoutLoading" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
</div>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalTitle">Item List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <ul class="list-group">
                        <template x-for="cartItem of cartItems">
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <span x-text="cartItem.name"></span>
                                    <div>
                                        <button class="btn btn-sm btn-icon" x-on:click="function(){
                                            let item = cartItems.find(item => item.id == cartItem.id);
                                            if(item){
                                                if(item.quantity > 1){
                                                    item.quantity = item.quantity-1;
                                                }else{
                                                    const willDeleteIndex = cartItems.map(item => item?.id).indexOf(cartItem.id)
                                                    cartItems.splice(willDeleteIndex, 1)
                                                }
                                                cartCount = cartCount-1;
                                            }
                                        }"><i class="bi bi-dash-square-fill"></i></button>
                                        <span x-text="cartItems.find(item => item.id == cartItem.id)?.quantity || 0"></span>
                                        <button class="btn btn-sm btn-icon" x-on:click="function(){
                                            let item = cartItems.find(item => item.id == cartItem.id);
                                            if(item){
                                                item.quantity = item.quantity+1;
                                                cartCount = cartCount+1;
                                            }
                                        }"><i class="bi bi-plus-square-fill"></i></button>
                                    </div>
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
            <div class="position-absolute w-100 bottom-0 bg-dark d-flex justify-content-between align-items-center py-3 px-4 gap-3" style="z-index:1041">
                <span class="text-light">Total</span>
                <span class="text-info ms-auto">Rp. <span id="totalText" x-text="new Intl.NumberFormat('id-EN').format(cartItems.reduce((before, current) => before+(current.price * current.quantity), 0))">10.000,-</span></span>
                <form action="{{route('user.checkout')}}" method="post" x-on:submit="async function(){
                    $event.preventDefault()
                    const formData = new FormData($event.target)
                    checkoutLoading = true
                    for(let i in cartItems){
                        const item = cartItems[i]
                        formData.append('items[i][id]', item.id)
                        formData.append('items[i][quantity]', item.quantity)
                    }
                    try{
                        const {data} = await axios.post($event.target.action, formData)
                        console.log(data)
                    }catch(e){
                        console.error('Failed to checkout',e)
                    }
                    checkoutLoading = false
                }">
                    @csrf
                    <button type="submit" x-bind:class="`btn btn-sm ${cartCount > 0 ? 'btn-primary' : 'btn-secondary'}`" x-bind:disabled="!!!cartCount || checkoutLoading">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('heads')
<style>
    div,
    ul {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    ul,
    div::-webkit-scrollbar {
        display: none;
    }

    .showcaseMenuCategory>.nav-item>.nav-link {
        padding-top: 22px;
        padding-bottom: 22px;
        padding-left: 32px;
        padding-right: 32px;
    }

    .showcaseMenuCategory>.nav-item>.nav-link:not(.active) {
        color: var(--bs-dark);
        background-color: #e8e8e8 !important
    }

    .showcaseMenuCategory {
        gap: 8px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .menuCategoryContent {
        height: calc(100vh - 200.4px);
        overflow: auto;
    }
</style>
@endpush
