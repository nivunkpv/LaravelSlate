@if(false)
<div class="flex-shrink-0 text-white d-flex flex-column justify-content-between position-relative h-100"
    style="z-index: 100">
    <div class="overflow-y-auto bg-white d-flex flex-column align-items-center h-100 border-end">
        @foreach (mainmenu()->menu as $item)
            @if ($item->menu->where('visible',true)->count())
                <button @click="menu = '{{ $item->code }}'"
                    class="p-0 border-0 btn btn-sm btn-outline-light w-100 rounded-0 mb-2">
                    <div :class="menu == '{{ $item->code }}' ? 'border-end border-primary border-4 ' : ''"
                        class="d-flex flex-column align-items-center small text-uppercase @if ($item->isActive()) text-white bg-primary @else text-muted @endif px-2 py-3">
                        <i
                            class="fs-6 @if ($item->isActive()) animate__animated animate__faster animate__fadeInLeft @endif {{ $item->icon }}"></i>
                        <div class="px-1">
                            <small>
                                <b>
                                    {{ $item->name }}
                                </b>
                            </small>
                        </div>
                    </div>
                </button>
            @else
                <a href="{{ $item->link }}"
                    class="p-0 border-0 btn btn-sm btn-outline-light w-100 rounded-0 mb-2">
                    <div {{-- :class="menu == '{{ $item->code }}' ? 'border-end border-primary border-4' : ''" --}}
                        class="d-flex flex-column align-items-center small text-uppercase @if ($item->isActive()) text-white bg-primary @else text-muted @endif px-2 py-3">
                        <i
                            class="fs-6 @if ($item->isActive()) animate__animated animate__faster animate__fadeInLeft @endif {{ $item->icon }}"></i>
                        <div class="px-1">
                            <small>
                                <b>
                                    {{ $item->name }}
                                </b>
                            </small>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</div>
<div class="overflow-auto bg-white shadow position-absolute border-start border-end h-100"
    x-show="(menu && Object.keys(__menu[menu].menu).length)" x-data="{ 'route': '{{ Route::currentRouteName() }}' }"
    x-transition:enter="animate__animated animate__fadeInLeft animate__faster" x-cloak
    x-transition:leave="animate__animated animate__fadeOutLeft animate__faster"
    style="top:0rem;left: 5rem;z-index: 99;width: 16rem;">
    <template x-if="(menu && Object.keys(__menu[menu].menu).length)">
        <div class="pb-2 mx-3 mt-3">
            <div class="d-flex justify-content-between align-items-end border-bottom">
                <button @click="menu=null"
                    class="border-0 btn btn-outline-light btn-sm fw-bold text-secondary text-uppercase">
                    <small><i class="bi bi-arrow-left"></i></small>
                </button>
                <div class="fs-6 text-uppercase text-secondary">
                    <b x-text="__menu[menu].name"></b>
                </div>
            </div>
            <br>
            <div class="gap-2 d-flex flex-column">
                <template x-for="item in __menu[menu].menu">
                    <div>
                        <template x-if="Object.keys(item.menu).length>0 && item.visible" x-init="console.log(item.menu.length)">
                            <div class="gap-2 p-2 mb-2 bg-white border rounded btn-sm w-100"
                                :class="item.route == route ? 'text-primary shadow-sm ' : 'text-muted'">
                                <div class="py-1 mb-2 d-flex small align-items-center">
                                    <span><i class="" :class="item.icon"></i></span>
                                    <span class="px-2 text-uppercase small">
                                        <b x-text="item.name"></b>
                                    </span>
                                </div>
                                <div class="gap-2 d-flex flex-column">
                                    <template x-for="child_item in item.menu">
                                        <a :href="child_item.link"
                                            class="gap-2 py-2 btn btn-light btn-sm w-100 d-flex small align-items-center"
                                            :class="child_item.route == route ?
                                                'text-primary border-0 border-end border-5 border-primary' :
                                                'text-muted'">
                                            <span><i class="" :class="child_item.icon"></i></span>
                                            <span class="text-uppercase small">
                                                <b x-text="child_item.name"></b>
                                            </span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>
                        <template x-if="Object.keys(item.menu).length==0 && item.visible">
                            <a :href="item.link"
                                class="gap-2 py-2 btn btn-light btn-sm w-100 d-flex small align-items-center"
                                :class="item.route == route ? 'text-primary border-0 border-end border-5 border-primary' :
                                    'text-muted'">
                                <span><i class="" :class="item.icon"></i></span>
                                <span class="text-uppercase small">
                                    <b x-text="item.name"></b>
                                </span>
                            </a>
                        </template>
                    </div>
                </template>
            </div>

        </div>
    </template>
</div>
<div x-show="(menu && Object.keys(__menu[menu].menu).length)"
    x-transition:enter="animate__animated animate__fadeIn animate__faster"
    x-transition:leave="animate__animated animate__fadeOut animate__faster" x-cloak @click="menu = false"
    class="top-0 bottom-0 position-fixed end-0 start-0"
    style="z-index: 90;backdrop-filter: blur(3px); background: rgb(0 0 0 / 10%);">
</div>
@endif

{{-- mobile --}}
<div class="overflow-auto position-absolute start-0 h-100 bg-white animated-slow d-block d-sm-none" x-cloak style="width: 14rem;z-index:150"
:style="runtime.sidebar.visible?{}:{marginLeft:'-14rem'}" :class="runtime.sidebar.visible?'shadow':''">
@include('glide.menu.mainmenu')
</div>

{{-- desktop --}}
<div class="overflow-auto h-100 bg-white border-end animated-slow flex-shrink-0 d-none d-sm-block shadow-sm" style="width: 14rem;z-index:150"
:style="runtime.sidebar.visible?{}:{marginLeft:'-14rem'}">
@include('glide.menu.mainmenu')
</div>

<div :class="runtime.sidebar.visible?'d-block d-sm-none':'d-none'"
    x-transition:enter="animate__animated animate__fadeIn animate__faster"
    x-transition:leave="animate__animated animate__fadeOut animate__faster" x-cloak @click="runtime.sidebar.visible = false"
    class="top-0 bottom-0 position-fixed end-0 start-0"
    style="z-index: 90;backdrop-filter: blur(2px); background: rgb(0 0 0 / 10%);">
</div>
