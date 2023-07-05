
<div class="datos_trabajador">
  <div class="row rowaux">
    <div class="col-sm-4"> 
      <div class="form-group">
        <label class="col-sm-12 control-label labelleft letranegrita">DNI </label> 
        <div class="col-sm-7 abajocaja"> 
          <!-- <input type="hidden"
              id="trabajador_id" name='trabajador_id' 
              value="@if(isset($trabajador)){{old('trabajador_id',$trabajador->id)}} @endif"
              class="form-control input-xs" data-aw="59"/> -->
          <input type="text" disabled
                id="dni" name='dni'                                                   
                value="@if(isset($trabajador)){{old('dni',$trabajador->dni)}}@else{{old('dni')}}@endif" 
                class="form-control input-xs" data-aw="5"/>
        </div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="form-group">
        <label class="col-sm-12 control-label labelleft letranegrita">Fecha Ingreso</label> 
        <div class="col-sm-7 abajocaja"> 
          <input type="text" disabled
                id="fechaingreso" name='fechaingreso'
                style="background-color: #FFF59D;" 
                value="@if(isset($trabajador)){{old('fechaingreso',$trabajador->fechaingreso)}}@else{{old('fechaingreso')}}@endif" 
                class="form-control input-xs" data-aw="5"/>
        </div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="form-group">
        <label class="col-sm-12 control-label labelleft letranegrita">Fecha Baja</label> 
        <div class="col-sm-7 abajocaja">
          <input type="text" disabled
                id="fechabaja" name='fechabaja'
                style="background-color: #FFF59D;" 
                value="@if(isset($trabajador)){{old('fechabaja',$trabajador->fechabaja)}}@else{{old('fechabaja')}}@endif" 
                class="form-control input-xs" data-aw="5"/>
        </div>
      </div>
    </div>      
  </div>
  
  <div class="row rowaux">
    <div class="col-sm-12">
      <div class="form-group">
        <label class="col-sm-12 control-label labelleft letranegrita">Cargo </label> 
        <div class="col-sm-7 abajocaja"> 
          <input type="text" disabled
            id="ocupacion" name='ocupacion'                                           
            value="@if(isset($trabajador)){{old('ocupacion',$trabajador->cargo->descripcion )}}@else{{old('ocupacion')}}@endif" 
            class="form-control input-xs" data-aw="5"/>                                        
        </div>
      </div>
    </div>
  </div>
  
  <div class="row rowaux">
    <div class="col-sm-12">
      <div class="form-group">
        <label class="col-sm-12 control-label labelleft letranegrita">Área </label> 
        <div class="col-sm-7 abajocaja"> 
          <input type="text" disabled
              id="area" name='area'                                             
              value="@if(isset($trabajador)){{old('area',$trabajador->area->descripcion )}}@else{{old('area')}}@endif" 
              autocomplete="off" class="form-control input-xs" data-aw="5"/>                                          
        </div>
      </div>
    </div>
  </div>
</div>
  
  <script type="text/javascript">
  $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.formElements();
    });
</script>