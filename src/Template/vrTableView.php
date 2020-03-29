<table class="table table-striped table-dark table-hover">
                <thead class="thead-light">
                    <tr>
                        <?php foreach($tableColName as $colName){
                            echo'<th class="text-center">'."{$colName}</th>";
                        }?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $data as $tuple):?> 
                        <tr onclick="setSelection(this)">
                            <?php foreach($tuple as $value){
                                print("<td>{$value}</td>");
                            }?>
                        </tr>
                    <?php endforeach;?>         
                </tbody>
            </table>
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>