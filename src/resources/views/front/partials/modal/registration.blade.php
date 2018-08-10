<div class="ui modal modal-register" style="position: relative; overflow: visible;">
    <i class="close icon"></i>
    <div class="content">
        <div class="dialog">
            <a href="#">
                <img src="{{ asset('assets/img/topditop-logo.jpg') }}" class="topditop-logo img-responsive" alt="TopDiTop Home Logo">
            </a>
            <hr>
            <h2>TopDiTop Store Registrierung</h2>
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
                        <input name="{{$field->key}}" id="registerfield-{{$field->key}}"
                               type="{{ ($field->key == 'email') ? 'email' : 'text' }}"
                               placeholder="{{$field->name}}" @if($field->key == 'email') required  @endif>
                    </div>
                @endforeach

                <div class="checkbox">
                    <input type="checkbox" id="confirm_field" name="confirm_field">
                    <label for="confirm_field">
                        Qualitätszeugnis: Ich erkläre hiermit ausdrücklich in meinem Store real und digital
                        ausschließlich Premium- Produkte und Originale anzubieten. Es handelt sich dabei um
                        Designer-Erzeugnisse oder Produkte aus Designmanufakturen, die patentrechtlich geschützt
                        sind. Als TopDiTop – Partner darf ich das Markenzeichen von TopDiTop, das für den absoluten
                        Premium-Designhandel steht, in meiner Kommunikation führen. Den Handel mit Kopien oder
                        minderwertiger Ware, die in Discount Kaufhäusern angeboten wird, kann ich ausschließen.
                        Andernfalls ist es mir bewusst, dass ich mit sofortiger Wirkung von TopDiTop-Home
                        ausgeschlossen werde und das Markenzeichen von TopDiTop in keiner Weise mehr nutzen darf.
                        Das Mietverhältnis kann spätestens drei Monate vor Ablauf der Frist gekündigt werden,
                        andernfalls verlängert sich das Mietverhältnis um ein weiteres Jahr.
                    </label>
                </div>
                {{csrf_field()}}
                <button class="click-button" href="#">Submit Registration</button>

            </form>
        </div>
    </div>
</div>