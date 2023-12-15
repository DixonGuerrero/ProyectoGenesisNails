



    <header>

        <a href="#" class="logo">

            <img src="./assets/images/logo.png" alt="">

        </a>

        <nav>
            <a href="index.php?vista=home" class="hero_btn">Inicio</a>

        </nav>

    </header>


    <section>

        <article class="formulario_de_registro">

            <h1 class="titulo-formulario">Formulario de Registro</h1>

            <div class="formulario-registro" class="row">



                <form>

                    <fieldset float="left" width="48%">
                        <legend>Datos personales</legend>

                        <div>
                            <label for="nombre">Nombres</label>
                            <input type="text" id="nombres" 
                            pattern="[a-zA-Z\s']{2,30}"
                            name="nombre"/>
                        </div>

                        

                        <div>
                            <label for="apellido">Apellidos</label>
                            <input type="text" id="apellido" 
                            pattern="[a-zA-Z\s']{2,30}"
                            name="apellidos" />
                        </div>

                        

                        <div>
                            <label for="id">Cedula de ciudadania</label>
                            <input type="text" id="id" 
                            pattern="\d{8,20}"
                            name="id"/>
                        </div>



                        <div>
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" 
                            pattern="[0-9\s+]+"
                            name="telefono" />
                        </div>

                        <div>
                            <label for="usuario">Usuario</label>
                            <input type="text" id="usuario"  
                            pattern="[a-zA-Z0-9]{3,20}"
                            name="usuario"/>
                        </div>

                        <div>
                            <label for="email">Correo Electronico</label>
                            <input type="text" id="email"  
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,50}"
                            name="email"/>
                        </div>

                        <div>
                            <label for="id">Contraseña</label>
                            <input type="text" id="clave1"  
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}"
                            name="clave1"/>
                        </div>



                        <div>
                            <label for="fecha de nacimiento">Confirmar Contraseña</label>
                            <input type="text" id="clave2" 
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}"
                            name="clave2" />
                        </div>

                    </fieldset>


                </form>


                <div class="botones" text-align="center">

                    <input type="submit" value="Aceptar" class="boton b_aceptar">
                    <input type="reset" value="Limpiar" class="boton b_limpiar">

                </div>



            </div>

        </article>



    </section>
    <footer>

        <h3 class="pieDePagina"> By Salón de Belleza Génesis Nails</h3>

    </footer>



