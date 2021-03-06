    <footer class="text-center">
                <div class="footer-above">
                    <div class="container">
                        <div class="row">
                            <div class="footer-col col-md-4">
                                <!--<p><a href="#"><i class="fa fa-lg fa-sign-in"></i> Registrase</a></p>-->
                            </div>
                            <div class="footer-col col-md-4">
                                <span>CURSOS</span>
                                <ul class="list-inline">
                                    <li>
                                        <p>Inglés</p>
                                    </li>
                                    <li>
                                        <p>Computación</p>
                                    </li>
                                    <li>
                                        <p>Diseño gráfico</p>
                                    </li>
                                    <li>
                                        <p>Diseño web</p>
                                    </li>
                                </ul>            
                            </div>
                            <div class="footer-col col-md-4">
                            <!--  <p><a href="/avirtual/login"><i class="fa fa-lg fa-user"></i> Iniciar Sesión</a></p>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-below">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                Copyright &copy; <span id="year"> </span>  <cite>englishcomputer</cite>  - Admin by <a href="https://charlescode.wordpress.com">Csharls</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <div class="scroll-top page-scroll">
                <a class="btn btn-primary" href="#page-top">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
    </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous" defer></script>
        <script src="../js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" crossorigin="anonymous"></script>
        <script src="../js/freelancer.js" defer></script>
        <script>
                var year= new Date();
                document.querySelector("span#year").textContent= year.getFullYear().toString();

                var navHeight = $('.navbar').height();
                var windowH = $(window).height();
                var scrollTopbtn=document.querySelector("div.scroll-top");

             
                $(document).scroll(function(){
                    var scrolltop = $(this).scrollTop();
                    if(scrolltop>0){
                            scrollTopbtn.classList.remove("d-none");
                        }
                        else{
                            scrollTopbtn.classList.add("d-none");
                        }
                });
        </script>
    </body>
</html>