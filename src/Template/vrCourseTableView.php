           <table class="table table-striped table-dark table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Id</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $data as $course): 
                  print( "<tr onclick=".'"setSelection(this)"'.">
                        <td>{$course["Name"]}</td>
                        <td>{$course["CourseID"]}</td>
                    </tr>");
                    endforeach;?>         
                </tbody>
            </table>
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>