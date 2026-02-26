<!-- Deleted inFormation Student -->
<div class="modal fade" id="Return_Student{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                  @if(session()->has('flasher::envelopes'))
                    @foreach(session('flasher::envelopes') as $envelope)
                        @php
                            // Envelope provides getNotification(); the Notification has getMessage() and getType()
                            try {
                                $notification = method_exists($envelope, 'getNotification') ? $envelope->getNotification() : null;
                                $message = $notification && method_exists($notification, 'getMessage') ? $notification->getMessage() : null;
                                $type = $notification && method_exists($notification, 'getType') ? $notification->getType() : 'info';
                            } catch (\Throwable $ex) {
                                $message = null;
                                $type = 'info';
                            }
                        @endphp
                        @if($message)
                            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                                {!! $message !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    @endforeach
                @endif
              
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">ارجاع طالب</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Graduated.update','test')}}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{$student->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من الغاء عملية التخرج ؟</h5>
                    <input type="text" readonly value="{{$student->name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>