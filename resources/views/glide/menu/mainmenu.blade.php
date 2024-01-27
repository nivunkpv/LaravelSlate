<div class="h-100 d-flex flex-column">
    <div class="flex-shrink-0 py-2">
    @foreach (mainmenu()->menu as $item)
        @if ($item->menu->where('visible', true)->count())
            <div x-data="{ hover: false }" 
            @mouseover="hover=true" @mouseleave="hover=false" 
             {{-- :class="hover ? 'shadow-sm' : ''" --}}
                class="mb-1 mt-2 mx-2">
                <small class="px-2 pt-1 text-uppercase d-block">
                    {{-- <i class="fs-6 text-muted {{ $item->icon }}"></i> --}}
                    <small class="@if ($item->isActive())fw-bold text-primary @else text-muted @endif animated" :class="hover ? 'fw-bold' : ''">
                        {{ $item->name }}
                    </small>
                </small>
                <hr class="m-0 my-1 @if ($item->isActive())  text-primary @else @endif">
                <div class="mb-3">
                    @foreach ($item->menu as $item)
                        <div class="@if ($item->isActive()) px-2 py-1 @endif">
                            <a href="{{ $item->link }}"
                                class="btn btn-sm border-0 fw-bold w-100 py-1 text-start d-flex align-items-lg-center @if ($item->isActive()) px-3 btn-primary rounded-3  @else px-4 rounded-0 btn-outline-light text-muted @endif"
                                type="button">
                                <i class="fs-6 {{ $item->icon }}"></i>
                                <small class="px-2 py-1 text-uppercase">
                                    <small class="">
                                        {{ $item->name }}
                                    </small>
                                </small>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            @if ($loop->iteration > 0)
                {{-- <div class="bg-primary-subtle" style="height: 1px"></div> --}}
            @endif
            <div class="@if ($item->isActive())  @endif px-2 my-1">
                <a href="{{ $item->link }}" x-data="{ hover: false }" 
                    {{-- @mouseover="hover=true" @mouseleave="hover=false"  --}}
                    class="btn btn-sm border-0 fw-bold w-100 py-2 text-start d-flex align-items-lg-center @if ($item->isActive()) px-3 btn-primary rounded-3  @else px-3 rounded-0 btn-outline-light text-muted rounded-3 @endif"
                    type="button" :class="hover?'shadow-sm':''">
                    <i class="fs-6 {{ $item->icon }}"></i>
                    <small class="px-3 py-1 text-uppercase">
                        <small class="">
                            {{ $item->name }}
                        </small>
                    </small>
                </a>
            </div>
        @endif
    @endforeach
    </div>
    <div class="flex-grow-1">
    </div>
</div>
