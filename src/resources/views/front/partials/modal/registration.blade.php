<div class="ui modal modal-register" style="position: relative; overflow: visible;">
    <i class="close icon"></i>
    <div class="content">
        <div class="dialog">
            <a class="navbar-brand" href="{{ route('dashboard_home') }}">Top<span
                        class="navbar-brand--logo-mod">di</span>Top
                H.O.M.E.</a>
            <h2>Registration</h2>
            <p>Eröffnen Sie Ihren TopDiTop-Store. Nach Eingang Ihrer Registríerung senden wir Ihnen die Informationen
                zur Eröffnung eines TopDiTop Stores per Email. Wir freuen uns auf Ihren Store.</p>
            <form role="form" method="POST" action="{{ url('/register') }}">
                <div class="form-group">
                    <label for="firma">Firma:</label>
                    @foreach($registerfields_firma as $field)
                        <input name="{{$field->key}}" id="registerfield-{{$field->key}}" type="text"
                               placeholder="{{$field->name}}">
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="partner">Ansprechpartner:</label>
                </div>
                @foreach($registerfields_ansprechpartner as $field)
                    <div class="form-group">
                        <input name="{{$field->key}}" id="registerfield-{{$field->key}}" type="text"
                               placeholder="{{$field->name}}">
                    </div>
                @endforeach

                <div class="checkbox">
                    <input type="checkbox" id="confirm_field" name="confirm_field">
                    <label for="confirm_field">
                        Qualitätszeugnis: Ich erkläre hiermit ausdrücklich in meninem Store real und digital
                        ausschliesslich Premium-Produkte und Originale anzubieten. Es handelt Designer-Erzeugnisse oder
                        Produkte aus
                        Designmanufakturen, dies patentrechtlich geschützt sind. Als TopDiTop-Partner darf ich das
                        marketzeihnen von TopDiTop, das fur den absoluten Premium-designhandel steht in meiner
                        Kommunikation führen.
                    </label>
                </div>
                {{csrf_field()}}
                <button class="click-button" href="#">Submit Registration</button>

            </form>
        </div>
    </div>
</div>