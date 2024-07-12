<style>
    #eyepassword{
        
    }

</style>
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            

                <h1 class="logo-name" style="margin-right: 10px;">SimCloud</h1>

        
            <form class="m-t" method="post" role="form">
                <div class="form-group">
                    <input type="text" name="ingUsuario" class="form-control" placeholder="Usuario" required="">
                </div>
                <div class="form-group">
                    <input 
                        type="password" 
                        id="ingPassword" 
                        name="ingPassword" 
                        class="form-control" 
                        placeholder="Contraseña" 
                        required=""
                       
                    />
                    <i 
                        class="fa fa-eye" 
                        id="eyepassword" 
                        style="position: absolute; left: 100%; top: 74.5%;  margin-left: -30px; cursor: pointer; display: none;"></i>
                </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Ingresar</button>
                <a href="http://simcloud.com.co"><button type="button" class="btn btn-success block full-width m-b flex">Ir a la web</button></a>

                
                 <?php
 
                    $login = new ControladorUsuarios();
                    $login -> ctrIngresoUsuario();
        
                ?>
            </form>
        </div>
    </div>

    <script>
        $(document).on("input", "#ingPassword", function(){
            if($('#ingPassword').val() == ""){
                $('#eyepassword').hide();
            }else{
                $('#eyepassword').show();
            }
        })

        $(document).on("click", "#eyepassword", function(){
            if($('#ingPassword').attr("type") == "password"){
                $('#ingPassword').attr("type","text");
            }else{
                $('#ingPassword').attr("type","password");
            }
        })
        
    </script>