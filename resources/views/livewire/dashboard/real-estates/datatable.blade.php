<div>
    <x-alert id='alert' class="alert-success"></x-alert>

    <div class="card card-flush mt-6 mt-xl-9">

        <div class="card-header mt-5">

            <div class="card-title flex-column">
                <h3 class="fw-bolder mb-1">{{__("Real Estate")}}</h3>
                <div class="fs-6 text-gray-400">{{__("Show All")}}</div>
            </div>

            <div class="card-toolbar my-1">
                <div class="me-6 my-1">
                    <x-status></x-status>
                </div>
                <div class="me-6 my-1">
                    <x-city></x-city>
                </div>
                
                <div class="me-6 my-1">
                    <x-realestate-type></x-realestate-type>
                </div>
                <div class="d-flex align-items-center position-relative my-1">
                    <x-search-input></x-search-input>
                </div>
                <div class="d-flex align-items-center position-relative my-1">
                    @can('export real estates')
                    <x-export-button></x-export-button>
                    @endcan
                </div>
                <div class="d-flex align-items-center position-relative my-1">
                 
                    <button class="btn btn-sm btn-info" wire:click="NotifyUnActiveRealEstate"
                        wire:loading.class="spinner spinner-white spinner-left">
                        {{__("Notify")}}</button>
                    
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table
                        class="table table-row-brealEstateed table-row-dashed gy-4 align-middle fw-bolder dataTable no-footer"
                        role="grid">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr role="row">
                                <th wire:click="sortBy('id')" data-sort="{{$sortDirection}}">{{__("#")}}
                                    <x-sort field="id" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}"></x-sort>
                                </th>
                                <th wire:click="sortBy('ar_name')" data-sort="{{$sortDirection}}" class="min-w-50px">
                                    {{__("Name")}}
                                    <x-sort field="ar_name" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('owner_id')" data-sort="{{$sortDirection}}" class="min-w-50px">
                                    {{__("Owner")}}
                                    <x-sort field="owner_id" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                
                                <th wire:click="sortBy('realestate_type_id')" data-sort="{{$sortDirection}}"
                                    class="min-w-90px">
                                    {{__("Realestate Type")}}
                                    <x-sort field="realestate_type_id" sortBy="{{$sortBy}}"
                                        sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                               
                               
                                <th wire:click="sortBy('is_active')" data-sort="{{$sortDirection}}" class="min-w-90px">
                                    {{__("Status")}}
                                    <x-sort field="is_active" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                               
                                <th wire:click="sortBy('created_at')" data-sort="{{$sortDirection}}" class="min-w-90px">
                                    {{__("Regester")}}
                                    <x-sort field="created_at" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th class="min-w-50px text-end" style="width: 87.075px;">{{__("Action")}}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @forelse($realEstates as $key => $realEstate)
                            <tr wire:loading.class="opacity-50">
                                <td>{{$loop->iteration}}</td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{route('admin.real-estates.show',$realEstate)}}"
                                                class="text-dark fw-bolder text-hover-primary fs-6">{{$realEstate->name}}</a>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{$realEstate->city->en_name}}</span>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    @if($realEstate->owner_id == 0)
                                    <span
                                        class="text-muted fw-bold text-muted d-block fs-7">{{__("Add By Admin")}}</span>
                                    @else
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{route('admin.owners.show',$realEstate->owner_id)}}"
                                                class="text-dark fw-bolder text-hover-primary fs-6">{{$realEstate->owner->first_name ?? ""}}</a>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{$realEstate->owner->mobile ?? ""}}</span>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>{{$realEstate->realestateType->en_name}}</td>
                                <td wire:click="changeActive({{$realEstate->id}})">
                                    {!!isActive($realEstate->is_active)!!}</td>
                               <td>{{$realEstate->created_at->format('m-d-Y')}}</td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        @can('show real estates')
                                        <x-show-button href="{{route('admin.real-estates.show',$realEstate)}}" />
                                        @endcan
                                        @can('edit real estates')
                                        <x-edit-button href="{{route('admin.real-estates.edit',$realEstate)}}" />
                                        @endcan
                                        @can('delete real estates')
                                        <x-delete-record-button wire:click="confirm({{ $realEstate->id }})" />
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-danger font-size-lg">
                                    {{ __('No records found') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div
                        class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                    </div>
                    <div
                        class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        {{$realEstates->links()}}
                    </div>
                </div>
            </div>
            <!--end::Table-->

            <!--end::Table container-->
        </div>
        <!--end::Card body-->
    </div>
    <x-delete-modal></x-delete-modal>
</div>

@section('scripts')

<script type="text/javascript">
    window.livewire.on('openDeleteModal', () => {
        $('#deleteModal').modal('show');
    }); 
    window.livewire.on('closeDeleteModal', () => {
        $('#deleteModal').modal('hide');
    });
</script>
@endsection