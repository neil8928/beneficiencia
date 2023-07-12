<nav class="nav-sidebar">
    <ul class="nav tabs">
        <li class="active">
            <a href="#tpdatosgenerales" class='textomenu' data-toggle="tab">
                Datos Generales
            </a>
        </li>
        <li>
            <a href="#tpinformacionfamiliar" class='textomenu' data-toggle="tab">
                Información Familiar
            </a>
        </li>
        <li id='mtpsalud'>
            <a  href="#tpsalud"             
                class='textomenu tabsalud' 
                data-toggle="tab" 
                data_ficha='{{ $idregistro }}'
                data_opcion='{{ $idopcion }}'>
                Salud
            </a>
        </li>
        <li id='mtpsituacioneconomica'>
            <a href="#tpsituacioneconomica" 
                class='textomenu tabse' 
                data-toggle="tab" 
                data_ficha='{{ $idregistro }}'
                data_opcion='{{ $idopcion }}'>
                Situación Económica
            </a>
        </li>
        <li id='mtpbeneficios'>
            <a href="#tpbeneficios"                 
                class='textomenu tabapoyo' 
                data-toggle="tab" 
                data_ficha='{{ $idregistro }}'
                data_opcion='{{ $idopcion }}'>
                Beneficios
            </a>
        </li>
        <li>
            <a href="#tpvivienda" class='textomenu' data-toggle="tab">
                Vivienda
            </a>
        </li>
        <li>
            <a href="#tpconvivenciafamiliar" class='textomenu' data-toggle="tab">
                Convivencia Familiar
            </a>
        </li>
        {{-- <li>
            <a href="#tpdocumentosficha" class='textomenu' data-toggle="tab">
                Documentos Ficha
            </a>
        </li>  --}}       
        <li>
            <a href="#tpevaluacionprofesional" class='textomenu' data-toggle="tab">
                Evaluacion Profesional
            </a>
        </li>
    </ul>
</nav>

