@extends('layouts.app')

@section('content')
 <div class="container">
     <div class="row">
        <div class="card">
           

            <form action="{{ url('upload')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
        
                <div class="input-group">
                    <label for="cuenta">Nombre de la cuenta:</label>
                </div>
                <br />
              
                <div class="input-group">
                    <input type="text" name="cuenta" class="form-control"/>
                </div>
                
                <br /><br />
                Mockups de la cuenta (puedes agregar mas de una version):
                <br />
                <input type="file" name="photos[]" multiple />
                <br /><br />
                <input type="submit" value="Upload"  class="btn btn-primary"/>
            </form>
        </div>
     </div>
 </div>
 @endsection
