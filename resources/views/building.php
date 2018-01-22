
        <div class="flex-center position-ref full-height">
            <div>

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Buildings</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">New Building</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div id="search_div">
                          <div class="row search_row">
                              <div class="col-sm-8 col-md-9">
                                <input type="text" class="form-control" placeholder="Alcatras ....." aria-describedby="basic-addon1">
                                <button type="button" class="btn btn-info" onclick="addSearchFilter()">+</button>
                               </div>
                              <div class="col-sm-4 col-md-3">
                                <button type="button" class="btn btn-info" >Search</button>
                              </div>
                          </div>
                        </div>
                        <table id="table_building" class="table table-responsive table-striped table-hover">
                            <thead class="thead-default">
                                <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Direction</th>
                                  <th>Phone</th>
                                  <th>Username</th>
                                  <th>Options</th>
                                </tr>
                            </thead>
                           <tbody id="table-building-content">
                                <tr>
                                  <th scope="row" class="col-sm-12 col-md-1">2</th>
                                  <td class="col-sm-12 col-md-2">Los Puchos</td>
                                  <td class="col-sm-12 col-md-3">Prados Del este,Avenida Rio de oro, Calle el arismendi. Quinta Los Puchos. Caracas-Venezuela</td>
                                  <td class="col-sm-12 col-md-2">(0058) 212-9799-284</td>
                                  <td class="col-sm-12 col-md-2">Omar Armando Angelino Laca</td>
                                  <td class="col-sm-12 col-md-2"><button type="button" class="btn btn-info">Edit</button></td>

                                </tr>
                                 <tr >
                                  <th scope="row" class="col-sm-12 col-md-1">3</th>
                                  <td class="col-sm-12 col-md-2">Los Puchos</td>
                                  <td class="col-sm-12 col-md-3">Prados Del este,Avenida Rio de oro, Calle el arismendi. Quinta Los Puchos. Caracas-Venezuela</td>
                                  <td class="col-sm-12 col-md-2">(0058) 212-9799-284</td>
                                  <td class="col-sm-12 col-md-2">Omar Armando Angelino Laca</td>
                                  <td class="col-sm-12 col-md-2"><button type="button" class="btn btn-info">Edit</button></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">2</div>
                    <div role="tabpanel" class="tab-pane" id="messages">3</div>
                  </div>

            </div>
            
                
                    

                
           
        </div>

        <script type="text/javascript">
            
            $('#home a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })


            $('#profile a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })


            $('#messages a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })


            $('#settings a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })

        function addSearchFilter()
        {
          var maxFilters = 3;
          if($('.search_row').length < maxFilters)
          {
            // we have to make in steps to add the onclick event
            var rowFilter = $( '<div class="row search_row"></div>');
            var colFilter = $( '<div class="col-sm-8 col-md-9"></div>');
            var searchValue = $( '<input type="text" name="busqueda" id="busqueda" value="" placeholder="Buscar Productos" maxlength="30" autocomplete="off" onKeyUp="search();" />');
            var searchOption = $( '<select name="filterchange" class="filterchange"><option value="name">Name</option><option value="direction">Direction</option><option value="phone">Phone</option><option value="username">Username</option></select>');
            var removeFilter = $( '<button type="button" class="btn btn-info" onclick="removeSearchFilter()">-</button>');
            //add evento to remove the row
            removeFilter.on('click', function(){
              rowFilter.remove();
            })
            colFilter.append(searchValue);
            colFilter.append(searchOption);
            colFilter.append(removeFilter);
            rowFilter.append(colFilter);
            $("#search_div").append(rowFilter);
          }
        }
      </script>

