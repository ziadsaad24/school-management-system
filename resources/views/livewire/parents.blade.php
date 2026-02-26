<div>
    <!-- Success/Error Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if($updateMode)
        @if($currentStep == 1)
            @include('livewire.Father_Form')
        @elseif($currentStep == 2)
            @include('livewire.Mother_Form')
        @elseif($currentStep == 3)
            <div class="row setup-content" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من حفظ البيانات ؟</h3><br>
                        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(2)">
                            {{ trans('Parent_trans.Back') }}
                        </button>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button" wire:click="submitForm_edit">
                            {{ trans('Parent_trans.Finish') }}
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @else
        <!-- Table -->
        <div class="table-responsive">
            <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                <thead>
                    <tr class="table-success">
                        <th>#</th>
                        <th>{{ trans('Parent_trans.Email') }}</th>
                        <th>{{ trans('Parent_trans.Name_Father') }}</th>
                        <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                        <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
                        <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                        <th>{{ trans('Parent_trans.Job_Father') }}</th>
                        <th>{{ trans('Parent_trans.Processes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($my_parents as $i => $my_parent)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $my_parent->Email }}</td>
                            <td>{{ $my_parent->Name_Father }}</td>
                            <td>{{ $my_parent->National_ID_Father }}</td>
                            <td>{{ $my_parent->Passport_ID_Father }}</td>
                            <td>{{ $my_parent->Phone_Father }}</td>
                            <td>{{ $my_parent->Job_Father }}</td>
                            <td>
                                <button wire:click="edit({{ $my_parent->id }})" 
                                        title="{{ trans('Grades_trans.Edit') }}" 
                                        class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" wire:click="confirmDelete({{ $my_parent->id }})" 
                                        title="{{ trans('Grades_trans.Delete') }}" 
                                        class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تأكيد الحذف</h5>
                        <button type="button" class="close" wire:click="cancelDelete">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف ولي الأمر؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelDelete">
                            إلغاء
                        </button>
                        <button type="button" class="btn btn-danger" wire:click="delete">
                            حذف
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function initDataTable() {
        if ($.fn.DataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().destroy();
        }
        $('#datatable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initDataTable();
        Livewire.on('refreshTable', function () {
            initDataTable();
        });
    });

    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            initDataTable();
        });
    });
</script>
@endpush