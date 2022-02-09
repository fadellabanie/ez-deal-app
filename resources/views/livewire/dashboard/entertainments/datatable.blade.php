<div>
    <x-alert id='alert' class="alert-success"></x-alert>

    <div class="card card-flush mt-6 mt-xl-9">

        <div class="card-header mt-5">

            <div class="card-title flex-column">
                <h3 class="fw-bolder mb-1">{{__("Entertainment")}}</h3>
                <div class="fs-6 text-gray-400">{{__("Show All")}}</div>
            </div>

            <div class="card-toolbar my-1">
                <div class="d-flex align-items-center position-relative my-1">
                    <x-search-input></x-search-input>
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
                                <th wire:click="sortBy('type')" data-sort="{{$sortDirection}}" class="min-w-50px">
                                    {{__("Type")}}
                                    <x-sort field="type" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th> 
                                <th wire:click="sortBy('en_title')" data-sort="{{$sortDirection}}" class="min-w-50px">
                                    {{__("Title")}}
                                    <x-sort field="en_title" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('address')" data-sort="{{$sortDirection}}" class="min-w-50px">
                                    {{__("Address")}}
                                    <x-sort field="address" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                
                                <th wire:click="sortBy('mobile')" data-sort="{{$sortDirection}}"
                                    class="min-w-90px">
                                    {{__("mobile")}}
                                    <x-sort field="mobile" sortBy="{{$sortBy}}"
                                        sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th> 
                                  <th wire:click="sortBy('from')" data-sort="{{$sortDirection}}"
                                    class="min-w-90px">
                                    {{__("from")}}
                                    <x-sort field="from" sortBy="{{$sortBy}}"
                                        sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>  
                                 <th wire:click="sortBy('to')" data-sort="{{$sortDirection}}"
                                    class="min-w-90px">
                                    {{__("to")}}
                                    <x-sort field="to" sortBy="{{$sortBy}}"
                                        sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('is_active')" data-sort="{{$sortDirection}}" class="min-w-90px">
                                    {{__("Status")}}
                                    <x-sort field="is_active" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                               
                              
                                <th class="min-w-50px text-end" style="width: 87.075px;">{{__("Action")}}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @forelse($entertainments as $key => $entertainment)
                            <tr wire:loading.class="opacity-50">
                                <td>{{$loop->iteration}}</td>

                                <td>{{$entertainment->type}}</td>
                                <td>{{$entertainment->en_title}}</td>
                                <td>{{$entertainment->address}}</td>
                                <td>{{$entertainment->mobile}}</td>
                                <td>{{$entertainment->from}}</td>
                                <td>{{$entertainment->to}}</td>
                               
                               <td>{{$entertainment->created_at->format('m-d-Y')}}</td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                      
                                        @can('edit entertainments')
                                        <x-edit-button href="{{route('admin.entertainments.edit',$entertainment)}}" />
                                        @endcan
                                        @can('delete entertainments')
                                        <x-delete-record-button wire:click="confirm({{ $entertainment->id }})" />
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
                        {{$entertainments->links()}}
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