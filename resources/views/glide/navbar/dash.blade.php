<div class="flex-shrink-0 px-2 px-md-3 py-3 shadow-sm d-flex justify-content-between bg-primary sticky-top align-items-center">
    <div class="d-flex justify-content-lg-start align-items-center">
        <button @click="runtime.sidebar.visible=!runtime.sidebar.visible" class="rounded-sm btn btn-primary btn-sm fs-6 fw-bold d-flex align-items-center">
            {{-- <i class="bi bi-lightning-charge-fill animate__animated animate__delay animate__jello"></i> --}}
            <i class="bi bi-compass-fill animate__animated animate__delay animate__jello"></i>
            {{-- <i class="bi bi-list"></i> --}}
            {{-- <img src="{{asset('draw/menu.svg')}}" class="text-white" style="width:1.3rem" /> --}}
        </button>
    </div>
    {{-- <img src="{{asset('logo_White.png')}}" width="135px" /> --}}
    <div class="flex-grow-1 fw-bold text-white d-flex align-items-center small text-uppercase px-2">
      {{env('APP_NAME')}}
    </div>
    <div class="gap-1 d-flex justify-content-end align-items-center position-relative">
        <button class="rounded-sm btn btn-primary btn-sm fs-6 fw-bold">
            <i class="bi bi-person-fill"></i>
        </button>
        <button class="rounded-sm btn btn-primary btn-sm fs-6 fw-bold">
          <i class="bi bi-gear-fill"></i>
      </button>
    </div>
</div>

