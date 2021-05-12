<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
          <script>
            var navbarStyle = localStorage.getItem("navbarStyle");
            if (navbarStyle && navbarStyle !== 'transparent') {
              document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
            }
          </script>
          <div class="d-flex align-items-center">
            <div class="toggle-icon-wrapper">
              <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            </div><a class="navbar-brand" href="../../admin.php">
              <div class="d-flex align-items-center py-3"><img class="mr-2" src="../../../images/logo_pwc.png" alt="" width="40" /><span class="font-sans-serif">LEX</span></div>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
            <div class="navbar-vertical-content scrollbar">
              <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#home" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
                    <div class="d-flex align-items-center">
                      <span class="nav-link-icon">
                        <span class="fas fa-chart-pie"></span>
                      </span>
                      <span class="nav-link-text"> Inicio</span>
                    </div>
                  </a>
                  <ul class="nav collapse" id="home" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="#">Gestor banner</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Crear indice</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Crear temas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Crear Subtemas</a></li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#contac" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="contac">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-id-card-alt"></span></span><span class="nav-link-text"> Contactos</span></div>
                  </a>
                  <ul class="nav collapse" id="contac" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../../modulo/empleado/employe.php">Empleados</a></li>
                    <li class="nav-item"><a class="nav-link" id="user" href="../../modulo/usuario/user.php">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../modulo/empleado/client.php">Clientes</a></li>   
                    <li class="nav-item"><a class="nav-link" href="../../modulo/empleado/client.php">Recuperar contraseña</a></li>                  
                  </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#publi" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="publi">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-newspaper"></span>
                            </span>
                            <span class="nav-link-text"> Publicaciones</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="publi" data-parent="#navbarVerticalCollapse">
                        <li class="nav-item"><a class="nav-link" id="bol" href="../../modulo/boletin/boletines.php">Boletines</a></li>
                        <li class="nav-item"><a class="nav-link" id="tax" href="../../modulo/taxAlert/taxAlert.php">Tax Alert</a></li>
                        <li class="nav-item"><a class="nav-link" id="publi" href="../../modulo/publicacion/publicacion.php">Publicacion</a></li>
                        <li class="nav-item"><a class="nav-link" id="com" href="../../modulo/comunicado/comunicado.php">Comunicados</a></li>
                    </ul>
                </li>
				<li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#chat" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="chat">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-comments"></span>
                            </span>
                            <span class="nav-link-text"> Chat</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="chat" data-parent="#navbarVerticalCollapse">
                        <li class="nav-item"><a class="nav-link" id="chatAdmin" href="../../modulo/chat/chatAdmin.php">Chat Administrador</a></li>
                    </ul>
                </li>                
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#backup" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="backup">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-calendar"></span>
                            </span>
                            <span class="nav-link-text"> Base de datos</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="backup" data-parent="#navbarVerticalCollapse">
                        <li class="nav-item"><a class="nav-link" id="backupWeb" href="#">Backup</a></li>
                    </ul>
                </li>
                <!-- <li class="nav-item"><a class="nav-link" href="../chat.html">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-comments"></span></span><span class="nav-link-text"> Chat</span></div>
                  </a></li>
                <li class="nav-item"><a class="nav-link" href="../kanban.html">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fab fa-trello"></span></span><span class="nav-link-text"> Kanban</span></div>
                  </a></li>
                <li class="nav-item"><a class="nav-link" href="../calendar.html">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-calendar-alt"></span></span><span class="nav-link-text"> Calendar</span></div>
                  </a></li>
                
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-unlock-alt"></span></span><span class="nav-link-text"> Authentication</span></div>
                  </a>
                  <ul class="nav collapse" id="authentication" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication-basic" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-basic">Basic</a>
                      <ul class="nav collapse" id="authentication-basic" data-parent="#authentication">
                        <li class="nav-item"><a class="nav-link" href="../authentication/basic/login.html">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/basic/logout.html">Logout</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/basic/register.html">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/basic/forgot-password.html">Forgot password</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/basic/reset-password.html">Reset password</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/basic/confirm-mail.html">Confirm mail</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/basic/lock-screen.html">Lock screen</a></li>
                      </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication-card" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-card">Card</a>
                      <ul class="nav collapse" id="authentication-card" data-parent="#authentication">
                        <li class="nav-item"><a class="nav-link" href="../authentication/card/login.html">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/card/logout.html">Logout</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/card/register.html">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/card/forgot-password.html">Forgot password</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/card/reset-password.html">Reset password</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/card/confirm-mail.html">Confirm mail</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/card/lock-screen.html">Lock screen</a></li>
                      </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication-split" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-split">Split</a>
                      <ul class="nav collapse" id="authentication-split" data-parent="#authentication">
                        <li class="nav-item"><a class="nav-link" href="../authentication/split/login.html">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/split/logout.html">Logout</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/split/register.html">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/split/forgot-password.html">Forgot password</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/split/reset-password.html">Reset password</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/split/confirm-mail.html">Confirm mail</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/split/lock-screen.html">Lock screen</a></li>
                      </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../authentication/wizard.html">Wizard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!" data-toggle="modal" data-target="#authentication-modal">In modal</a></li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-commerce" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-cart-plus"></span></span><span class="nav-link-text"> E commerce</span></div>
                  </a>
                  <ul class="nav collapse" id="e-commerce" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/checkout.html">Checkout</a></li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/customer-details.html">Customer details</a></li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/customers.html">Customers</a></li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/order-details.html">Order details</a></li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/orders.html">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/product-details.html">Product details</a></li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/product-grid.html">Product grid</a></li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/product-list.html">Product list</a></li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/shopping-cart.html">Shopping cart</a></li>
                  </ul>
                </li> -->
              </ul>
              <div class="navbar-vertical-divider">
                <hr class="navbar-vertical-hr my-2" />
              </div>
              <!-- <ul class="navbar-nav flex-column">
                <li class="nav-item"><a class="nav-link" href="../widgets.html">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-poll"></span></span><span class="nav-link-text"> Widgets</span></div>
                  </a></li>
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="components">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-puzzle-piece"></span></span><span class="nav-link-text"> Components</span></div>
                  </a>
                  <ul class="nav collapse" id="components" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../components/accordion.html">Accordion</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/alerts.html">Alerts</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/avatar.html">Avatar</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/background.html">Background</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/badges.html">Badges</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/breadcrumb.html">Breadcrumb</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/bulk-select.html">Bulk select</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/buttons.html">Buttons</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/cards.html">Cards</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/carousel.html">Carousel</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/close-button.html">Close button</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/collapse.html">Collapse</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/cookie-notice.html">
                        <div class="d-flex align-items-center">Cookie notice<span class="badge rounded-pill ml-2 badge-soft-success">New</span></div>
                      </a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/dropdowns.html">Dropdowns</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-disable" href="../components/fancyscroll.html">Fancyscroll</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-disable" href="../components/fancytab.html">Fancytab</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/figures.html">Figures</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/hoverbox.html">Hoverbox</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/images.html">Images</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/list-group.html">List group</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/modals.html">Modals</a></li>
                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#components-navbar" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="components-navbar">Navbar</a>
                      <ul class="nav collapse" id="components-navbar" data-parent="#components">
                        <li class="nav-item"><a class="nav-link" href="../components/navbar/default.html">Default</a></li>
                        <li class="nav-item"><a class="nav-link" href="../components/navbar/vertical.html">Vertical</a></li>
                        <li class="nav-item"><a class="nav-link" href="../components/navbar/darken-on-scroll.html">Darken on scroll</a></li>
                        <li class="nav-item"><a class="nav-link" href="../components/navbar/top.html">Top</a></li>
                        <li class="nav-item"><a class="nav-link" href="../components/navbar/combo.html">Combo</a></li>
                      </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../components/navs.html">Navs</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/page-headers.html">Page headers</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/pagination.html">Pagination</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/popovers.html">Popovers</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/progress.html">Progress</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/scrollspy.html">Scrollspy</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/search.html">
                        <div class="d-flex align-items-center">Search<span class="badge rounded-pill ml-2 badge-soft-success">New</span></div>
                      </a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/sidepanel.html">Sidepanel</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/spinners.html">Spinners</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/tables.html">Tables</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/tabs.html">Tabs</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/toasts.html">Toasts</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/tooltips.html">Tooltips</a></li>
                    <li class="nav-item"><a class="nav-link" href="../components/typography.html">Typography</a></li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="forms">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-align-left"></span></span><span class="nav-link-text"> Forms</span></div>
                  </a>
                  <ul class="nav collapse" id="forms" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../forms/checks.html">Checks</a></li>
                    <li class="nav-item"><a class="nav-link" href="../forms/file.html">File</a></li>
                    <li class="nav-item"><a class="nav-link" href="../forms/form-control.html">Form control</a></li>
                    <li class="nav-item"><a class="nav-link" href="../forms/input-group.html">Input group</a></li>
                    <li class="nav-item"><a class="nav-link" href="../forms/layout.html">Layout</a></li>
                    <li class="nav-item"><a class="nav-link" href="../forms/overview.html">Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="../forms/range.html">Range</a></li>
                    <li class="nav-item"><a class="nav-link" href="../forms/select.html">Select</a></li>
                    <li class="nav-item"><a class="nav-link" href="../forms/validation.html">Validation</a></li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#utilities" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="utilities">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-fire"></span></span><span class="nav-link-text"> Utilities</span></div>
                  </a>
                  <ul class="nav collapse" id="utilities" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../utilities/borders.html">Borders</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/clearfix.html">Clearfix</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/colored-links.html">Colored links</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/colors.html">Colors</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/display.html">Display</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/embed.html">Embed</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/flex.html">Flex</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/float.html">Float</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/grid.html">Grid</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/position.html">Position</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/sizing.html">Sizing</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/spacing.html">Spacing</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/stretched-link.html">Stretched link</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/text-truncation.html">Text truncation</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/vertical-align.html">Vertical align</a></li>
                    <li class="nav-item"><a class="nav-link" href="../utilities/visibility.html">Visibility</a></li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#plugins" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="plugins">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-plug"></span></span><span class="nav-link-text"> Plugins</span></div>
                  </a>
                  <ul class="nav collapse" id="plugins" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../plugins/anchor.html">Anchor</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/countup.html">Countup</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/choices.html">Choices</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/date-picker.html">Date picker</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/draggable.html">Draggable</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/dropzone.html">Dropzone</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/echarts.html">Echarts</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/emoji-button.html">Emoji button</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/fontawesome.html">Fontawesome</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/fullcalendar.html">Fullcalendar</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/glightbox.html">Glightbox</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/progressbar.html">Progressbar</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/inline-player.html">Inline player</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/list.html">List</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/lottie.html">Lottie</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/typed-text.html">Typed text</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/tinymce.html">Tinymce</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/swiper.html">Swiper</a></li>
                    <li class="nav-item"><a class="nav-link" href="../plugins/rater.html">Rater</a></li>
                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#plugins-map" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="plugins-map">Map</a>
                      <ul class="nav collapse" id="plugins-map" data-parent="#plugins">
                        <li class="nav-item"><a class="nav-link" href="../plugins/map/leaflet-map.html">Leaflet map</a></li>
                        <li class="nav-item"><a class="nav-link" href="../plugins/map/google-map.html">Google map</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
              <div class="navbar-vertical-divider">
                <hr class="navbar-vertical-hr my-2" />
              </div>
              <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#documentation" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="documentation">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-book"></span></span><span class="nav-link-text"> Documentation</span></div>
                  </a>
                  <ul class="nav collapse" id="documentation" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../documentation/getting-started.html">Getting started</a></li>
                    <li class="nav-item"><a class="nav-link" href="../documentation/file-structure.html">File structure</a></li>
                    <li class="nav-item"><a class="nav-link" href="../documentation/customization.html">Customization</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-disable" href="../documentation/dark-mode.html">Dark mode</a></li>
                    <li class="nav-item"><a class="nav-link" href="../documentation/fluid-layout.html">Fluid layout</a></li>
                    <li class="nav-item"><a class="nav-link" href="../documentation/gulp.html">Gulp</a></li>
                    <li class="nav-item"><a class="nav-link" href="../documentation/RTL.html">RTL</a></li>
                    <li class="nav-item"><a class="nav-link" href="../documentation/plugins.html">Plugins</a></li>
                    <li class="nav-item"><a class="nav-link" href="../documentation/design-file.html">Design file</a></li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="../changelog.html">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-code-branch"></span></span><span class="nav-link-text"> Changelog</span></div>
                  </a></li>
              </ul>
              <div class="settings">
                <div class="navbar-vertical-divider">
                  <hr class="navbar-vertical-hr my-3" />
                </div><a class="btn btn-sm btn-block btn-purchase" href="https://themes.getbootstrap.com/product/falcon-admin-dashboard-webapp-template/" target="_blank">Purchase</a>
              </div> -->
            </div>
          </div>
        </nav>

        <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-xl" style="display: none;">
          <button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3" type="button" data-toggle="collapse" data-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
          <a class="navbar-brand mr-1 mr-sm-3" href="../../admin.php">
            <div class="d-flex align-items-center"><img class="mr-2" src="../../../images/logo_pwc.png" alt="" width="40" /><span class="font-sans-serif">LEX</span></div>
          </a>
          <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
            <ul class="navbar-nav">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdownHome" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                    <div class="dropdown-menu dropdown-menu-card" aria-labelledby="navbarDropdownHome">
                        <div class="bg-white rounded-lg py-2">
                            <a class="dropdown-item" href="../index-2.html">Dashboard</a>
                            <a class="dropdown-item" href="../home/dashboard-alt.html">Dashboard alt</a>
                            <a class="dropdown-item" href="../home/feed.html">Feed</a><a class="dropdown-item" href="../home/landing.html">Landing </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownContac" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Contactos
                    </a>
                    <div class="dropdown-menu dropdown-menu-card" aria-labelledby="navbarDropdownContac">
                        <div class="bg-white rounded-lg py-2">                            
                            <a class="dropdown-item" href="../../modulo/empleado/employe.php">Empleados</a>
                            <a class="dropdown-item" id="user" href="../../modulo/empleado/user.php">Usuarios</a>
                            <a class="dropdown-item" href="../../modulo/empleado/client.php">Clientes</a>                                               
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownPubli" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Publicaciones
                    </a>
                    <div class="dropdown-menu dropdown-menu-card" aria-labelledby="navbarDropdownPubli">
                        <div class="bg-white rounded-lg py-2">
                            <a class="dropdown-item" id="bol" href="../../modulo/boletin/boletines.php">Boletines</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownChat" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Chat
                    </a>
                    <div class="dropdown-menu dropdown-menu-card" aria-labelledby="navbarDropdownChat">
                        <div class="bg-white rounded-lg py-2">
                            <a class="dropdown-item" id="chat" href="../../modulo/chat/chatAdmin.php">Chat Administrador</a>
                        </div>
                    </div>
                </li>           
              
              
            </ul>
          </div>
          <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">
            <li class="nav-item"><a class="nav-link settings-popover" href="#settings-modal" data-toggle="modal"><span class="ripple"></span><span class="fa-spin position-absolute all-0 d-flex flex-center"><span class="icon-spin position-absolute all-0 d-flex flex-center"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z" fill="#2A7BE4"></path></svg></span></span></a></li>
            
            <li class="nav-item dropdown">
              <a class="nav-link notification-indicator notification-indicator-primary px-0 icon-indicator" id="navbarDropdownNotification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell fs-4" data-fa-transform="shrink-6"></span></a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-card" aria-labelledby="navbarDropdownNotification">
                <div class="card card-notification shadow-none">
                  <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                      <div class="col-auto">
                        <h6 class="card-header-title mb-0">Notifications</h6>
                      </div>
                      <div class="col-auto"><a class="card-link font-weight-normal" href="#">Marcar todo cmo leido</a></div>
                    </div>
                  </div>
                  <!-- <div class="list-group list-group-flush font-weight-normal fs--1">
                    <div class="list-group-title border-bottom">NUEVO</div>
                    <div class="list-group-item">
                      <a class="notification notification-flush notification-unread" href="#!">
                        <div class="notification-avatar">
                          <div class="avatar avatar-2xl mr-3">
                            <img class="rounded-circle" src="../../assets/img/team/1-thumb.png" alt="" />
                          </div>
                        </div>
                        <div class="notification-body">
                          <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                          <span class="notification-time"><span class="mr-1" role="img" aria-label="Emoji">💬</span>Just now</span>
                        </div>
                      </a>
                    </div>
                    <div class="list-group-item">
                      <a class="notification notification-flush notification-unread" href="#!">
                        <div class="notification-avatar">
                          <div class="avatar avatar-2xl mr-3">
                            <div class="avatar-name rounded-circle"><span>AB</span></div>
                          </div>
                        </div>
                        <div class="notification-body">
                          <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
                          <span class="notification-time"><span class="mr-1 fab fa-gratipay text-danger"></span>9hr</span>
                        </div>
                      </a>
                    </div>
                    <div class="list-group-title border-bottom">ANTERIOR</div>
                    <div class="list-group-item">
                      <a class="notification notification-flush" href="#!">
                        <div class="notification-avatar">
                          <div class="avatar avatar-2xl mr-3">
                            <img class="rounded-circle" src="../../assets/img/icons/weather-sm.jpg" alt="" />
                          </div>
                        </div>
                        <div class="notification-body">
                          <p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's weather.</p>
                          <span class="notification-time"><span class="mr-1" role="img" aria-label="Emoji">🌤️</span>1d</span>
                        </div>
                      </a>
                    </div>
                  </div> -->
                  <div class="card-footer text-center border-top"><a class="card-link d-block" href="notifications.html">Ver todo</a></div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                  <img class="rounded-circle" src="../../assets/img/team/profile.png" alt="" />
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white rounded-lg py-2">
                    <span class="dropdown-item"><?=$_SESSION['nameUser']?></span></a>
                    <div class="dropdown-divider"></div>					
					<a class="dropdown-item" href="profile.html">Perfil &amp; cuenta</a>					
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="settings.html">Configuración</a>
					<a class="dropdown-item" href="../authentication/card/logout.html">Salir</a>
                </div>
              </div>
            </li>
          </ul>
        </nav>