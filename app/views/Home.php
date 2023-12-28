
    <!--Agregamos el header-->
    <header class="hero">
      <nav class="nav container">
        <img src="./assets/images/logo.png" alt="" class="img_nav" />

        <ul class="nav_list">
          <li><a href="" class="nav_link">Inicio</a></li>
          <li><a href="#quienesSomos" class="nav_link">Nosotros</a></li>
          <li><a href="#servicios" class="nav_link">Servicios</a></li>
          <li><a href="#testimonios" class="nav_link">Testimonios</a></li>
          <li><a href="#contacto" class="nav_link">Contacto</a></li>
        </ul>

        <a href="login" class="hero_btn">Ingresar</a>

        <a href="#menu" class="nav_menu">
          <img src="./assets/images/menuIcon.svg" alt="" class="nav_icon" />
        </a>

        <a href="#" class="nav_menu nav_menu--second">
          <img
            src="./assets/images/closeMenuIcon.svg"
            alt=""
            class="nav_icon"
          />
        </a>

        <ul class="dropdown" id="menu">
          <li class="dropdown_list">
            <a href="#" class="dropdown_link">
              <img
                src="./assets/images/homeIcon.svg"
                alt=""
                class="dropdown_icon"
              />
              <span class="dropdown_span">Inicio</span>
            </a>
          </li>

          <li class="dropdown_list">
            <a href="#quienesSomos" class="dropdown_link">
              <img
                src="./assets/images/nosotrosIcon.svg"
                alt=""
                class="dropdown_icon"
              />
              <span class="dropdown_span">Nosotros</span>
            </a>
          </li>

          <li class="dropdown_list">
            <a href="#" class="dropdown_link">
              <img
                src="./assets/images/servicios.svg"
                alt=""
                class="dropdown_icon"
              />
              <span class="dropdown_span">Servicios</span>
              <img
                src="./assets/images/flechaIcon.svg"
                alt=""
                class="dropdown_arrow"
              />

              <input type="checkbox" class="dropdown_check" />
            </a>

            <div class="dropdown_content">
              <ul class="dropdown_sub">
                <li class="dropdown_li">
                  <a href="#acrilico" class="dropdown_anchor"
                    >Uñas en acrilico</a
                  >
                </li>
                <li class="dropdown_li">
                  <a href="#cepilladoAlisado" class="dropdown_anchor"
                    >Cepillado y Alisado</a
                  >
                </li>
                <li class="dropdown_li">
                  <a href="#semipermanente" class="dropdown_anchor"
                    >Uñas en Semipermantente</a
                  >
                </li>
                <li class="dropdown_li">
                  <a href="#manicurePedicure" class="dropdown_anchor"
                    >Manicure y Pedicure Tradicional</a
                  >
                </li>
                <li class="dropdown_li">
                  <a href="#cejasdesing" class="dropdown_anchor"
                    >Diseño de Cejas</a
                  >
                </li>
                <li class="dropdown_li">
                  <a href="#extencionCejas" class="dropdown_anchor"
                    >Extension de Pestañas</a
                  >
                </li>
              </ul>
            </div>
          </li>

          <li class="dropdown_list">
            <a href="#testimonios" class="dropdown_link">
              <img
                src="./assets/images/comentariosIcon.svg"
                alt=""
                class="dropdown_icon"
              />
              <span class="dropdown_span">Opiniones</span>
            </a>
          </li>

          <li class="dropdown_list">
            <a href="#contacto" class="dropdown_link">
              <img
                src="./assets/images/contactoIcon.svg"
                alt=""
                class="dropdown_icon"
              />
              <span class="dropdown_span">Contacto</span>
            </a>
          </li>

          <li class="dropdown_list list-ingresar">
            <a href="login" class="dropdown_link link_ingresar">
              <img
                src="./assets/images/ingresarIcon.svg"
                alt=""
                class="dropdown_icon"
              />
              <span class="dropdown_span" href="login">Ingresar</span>
            </a>
          </li>
        </ul>
      </nav>

      <section class="hero_main container">
        <div class="hero_texts">
          <h1 class="hero_title">Genesis Nails</h1>
          <p class="hero_p">
            Donde la Belleza se Transforma en una Experiencia Inolvidable:
            Encuentra tu Destino de Estilo en Nuestro Salón
          </p>
          <a href="login" class="hero_cta" >Ingresa Ya!</a>
        </div>

        <figure class="hero_picture">
          <img
            src="./assets/images/logo.png"
            alt="LogoPortadaPagina"
            class="hero_img"
          />
        </figure>
      </section>
    </header>

    <!--Agregamos sobre nosotros-->
    <section class="sobreNosotros container" id="quienesSomos">
      <img
        src="./assets/images/salonBellezaImg.jpg"
        alt=""
        class="sb_img"
      />
      <div class="container-SB">
        <h2 class="sb_title">Quienes Somos</h2>
        <p class="sb_p">
          En Genesis Nails, somos un oasis de belleza y bienestar. Con pasión
          por la excelencia, ofrecemos una amplia gama de servicios de belleza,
          desde uñas de acrílico hasta extensiones de pestañas y más. Nuestro
          equipo de artistas altamente capacitados combina la creatividad con la
          precisión para realzar tu belleza natural. Nos enorgullece crear una
          experiencia relajante y rejuvenecedora para nuestros clientes, en un
          ambiente acogedor y elegante. Únete a nosotros y descubre un nuevo
          nivel de belleza y confianza.
        </p>
      </div>
    </section>

    <!--agregamos servicios-->
    <section class="servicios" id="servicios">
      <div class="container-S">
        <h2 class="s_title">Nuestros servicios</h2>
        <div class="containerServicios">
          <div class="cartaServicios" id="cepilladoAlisado">
            <h3 class="servicio_title">Cepillado y Alisado</h3>
            <p>
              ¡Transforma tu cabello con nuestro servicio de cepillado y alisado
              profesional! Obtén un look suave y pulido al instante. ¡Reserva
              ahor
            </p>
            <button href="index.php?vista=login" class="btn-servicios" >¡Reserva Ahora!</button>
          </div>
          <div class="cartaServicios" id="acrilico">
            <h3 class="servicio_title">Uñas en acrilico</h3>
            <p>
              ¡Transforma tus manos con elegantes uñas de acrílico! Estas
              extensiones de uñas, hechas de polímeros, se esculpen y endurecen
              para un look fabuloso. ¡Reserva ahora!
            </p>
            <button class="btn-servicios" href="index.php?vista=login">¡Reserva Ahora!</button>
          </div>
          <div class="cartaServicios" id="semipermanente">
            <h3 class="servicio_title" >Uñas en Semipermantente</h3>
            <p>
              ¡Eleva tu estilo con nuestras uñas semipermanentes expertamente
              aplicadas para un look duradero y sofisticado! ¡Reserva tu cita
              hoy mismo!
            </p>
            <button class="btn-servicios" href="index.php?vista=login">¡Reserva Ahora!</button>
          </div>
          <div class="cartaServicios" id="manicurePedicure">
            <h3 class="servicio_title">Manicure y Pedicure Tradicional</h3>
            <p>
              ¡Date un capricho con nuestro servicio de manicure y pedicure!
              Mimamos tus manos y pies para un look impecable y relajante.
              ¡Reserva ahora!
            </p>
            <button class="btn-servicios" href="index.php?vista=login">¡Reserva Ahora!</button>
          </div>
          <div class="cartaServicios" id="extencionCejas">
            <h3 class="servicio_title" >Extension de Pestañas</h3>
            <p>
              ¡Dale vida a tus ojos con nuestras extensiones de pestañas
              premium! Resalta tu belleza con pestañas largas y exuberantes.
              ¡Reserva ahora mismo tu cita!
            </p>
            <button class="btn-servicios" href="index.php?vista=login">¡Reserva Ahora!</button>
          </div>
          <div class="cartaServicios" id="cejasdesing">
            <h3 class="servicio_title">Diseño de Cejas</h3>
            <p>
              ¡Diseña tus cejas para enmarcar tu mirada! Nuestro servicio de
              diseño de cejas resalta tu belleza natural. ¡Reserva tu cita
              ahora!
            </p>
            <button class="btn-servicios" href="index.php?vista=login">¡Reserva Ahora!</button>
          </div>
        </div>
      </div>
    </section>

    <!--agregamos testimonios-->
    <section class="testimonios container" id="testimonios">
      <h2 class="testimonios_title">Opiniones</h2>
      <div class="container-testimonios">
        <div class="carta-Testimonios">
          <img
            src="./assets/images/Perfil 1.jpg"
            alt=""
            class="img_testimonios"
          />
          <div class="textoCarta">
            <h3 class="nombre_testimonio">Nombre</h3>
            <p class="testimonio_p">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
              sed solu Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, sunt!
            </p>
            <div class="calificacion">
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
            </div>
          </div>
        </div>
        <div class="carta-Testimonios">
          <img
            src="./assets/images/Perfil 2.jpg"
            alt=""
            class="img_testimonios"
          />
          <div class="textoCarta">
            <h3 class="nombre_testimonio">Nombre</h3>
            <p class="testimonio_p">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
              sed soluta consequuntur corrupti cum a reprehenderit tenetur unde
              minima saepe
            </p>

            <div class="calificacion">
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
            </div>
          </div>
        </div>
        <div class="carta-Testimonios">
          <img
            src="./assets/images/perfil4.jpg"
            alt=""
            class="img_testimonios"
          />
          <div class="textoCarta">
            <h3 class="nombre_testimonio">Nombre</h3>
            <p class="testimonio_p">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
              sed soluta consequuntur corrupti cum a reprehenderit tenetur unde
              minima saepe imp!
            </p>
            <div class="calificacion">
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
              <input type="radio" name="c1r1" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--agregamos contacto-->
    <section class="contacto container" id="contacto">
      <div class="contacto_texto">
        <h2 class="contacto_title texto">Contacto</h2>
        <p class="contacto_p">
          ¡En Genesis Nails, estamos aquí para ti! Ya sea para reservar una
          cita, consultar nuestros servicios o simplemente saludarnos, nuestro
          amable equipo está listo para ayudarte. Embellece tus uñas, transforma
          tu cabello o relájate con un manicure de primera. Contáctanos y
          descubre cómo podemos hacer que te sientas aún más bella.!
        </p>

        <h3 class="contacto_title_direccion">Direccion</h3>
        <p class="contacto_p">
          Calle Argentina #5-48 (frente al Distrito educativo), Buenaventura,
          Colombia
        </p>

        <h3 class="contacto_title_telefono">Telefono</h3>
        <p class="contacto_p">3103631728</p>

        <h3 class="contacto_title_email">Email</h3>
        <p class="contacto_p">GenesisNails@Hotmail.com</p>
      </div>

      <div class="form-Contacto">
        <h2 class="form_contacto_title">Contactanos</h2>
        <form action="" class="contacto_formulario">
          <div class="contacto_input-line">
            <label for="name" class="contacto_label">Nombre</label>
            <input
              type="text"
              name="name"
              id="name"
              placeholder="Ingrese su nombre"
              class="contacto_input"
            />
          </div>
          <div class="contacto_input-line">
            <label for="email" class="contacto_label">Email</label>
            <input
              type="text"
              name="email"
              id="email"
              placeholder="Ingrese su email"
              class="contacto_input"
            />
          </div>
          <div class="contacto_input-line">
            <label for="telefono" class="contacto_label">Telefono</label>
            <input
              type="text"
              name="telefono"
              id="telefono"
              placeholder="Ingrese su telefono"
              class="contacto_input"
            />
          </div>
          <div class="contacto_input-line">
            <label for="mensaje" class="contacto_label">Mensaje</label>
            <textarea
              type="text"
              name="mensaje"
              id="mensaje"
              placeholder="Ingrese su mensaje"
              class="contacto_input_textarea"
            ></textarea>
          </div>

          <input
            type="submit"
            value="Enviar mensaje"
            class="contacto_submit-boton"
          />
        </form>
      </div>
    </section>

    <!--agregamos footer-->
    <footer class="footer ">
      <div class="contenedorFooter container">

        <div class="grupo1">
  
          <div class="box">
            <figure class="container_img_footer">
              <a href="#"
                ><img
                  src="./assets/images/logo 4.png"
                  alt="logo de Genesis Nails" class="footer_img"
              /></a>
            </figure>
          </div>
          <div class="box">
            <h2>SOBRE NOSOTROS</h2>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, fugiat.
            </p>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, fugiat.
            </p>
          </div>
          <div class="box">
            <h2>SIGUENOS</h2>
            <div class="redesSociales">
              <a href="#" class="fa-brands fa-facebook"></a>
              <a href="#" class="fa-brands fa-whatsapp"></a>
              <a href="#" class="fa-brands fa-instagram"></a>
              <a href="#" class="fa-brands fa-twitter"></a>
            </div>
          </div>
        </div>
        <div class="grupo2">
  
          <small>&copy; 2023 <b>Génesis Nails</b> - Todos los derechos reservados</small>
        </div>
      </div>
    </footer>

  

