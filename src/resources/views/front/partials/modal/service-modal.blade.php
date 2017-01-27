<div class="ui modal modal-final-register" style="position: relative; overflow: visible;">
    <i class="close icon"></i>
    <div class="dialog">
        <a class="navbar-brand" href="http://78.46.218.38/topditop2/dashboard">Top<span
                    class="navbar-brand--logo-mod">di</span>Top
            H.O.M.E.</a>
        <h2>TopdiTopStore</h2>
        <form method="post" class="final-register-form" action="{{route('confirm_registration', $user)}}">
            @foreach($registerfields_service as $field)
                <div class="form-group">
                    <label for="registerfield-{{$field->key}}">{{$field->name}}:</label>
                    <input name="{{$field->key}}" id="registerfield-{{$field->key}}" type="text"
                           placeholder="{{$field->name}}">
                </div>
            @endforeach
            <div class="checkbox">
                <input type="checkbox" id="confirm-field1" name="confirm_field_service">
                <label for="confirm-field1">
                    Ja ich bin damit einverstanden, dass die monatlichen Kosten für meinen TopDiTop Store vom diesem
                    Konto per Lastschrift abgebucht werden. Die Kosten werden jeweils am Quartalsende abgebucht.
                </label>
            </div>
            <input type="hidden" name="package_id" class="package-id">
            <input type="hidden" name="bondtype" class="bondtype">
            <input type="hidden" name="term_acceptance_1" class="term_acceptance_1">
            {{csrf_field()}}
            <button class="click-button" href="#">{{ trans('messages.accept_and_create') }}</button>

        </form>
    </div>
</div>