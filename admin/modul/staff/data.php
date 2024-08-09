<div class="page-inner">
          <div class="page-header">
            <h4 class="page-title">Staff</h4>
            <ul class="breadcrumbs">
              <li class="nav-home">
                <a href="#">
                  <i class="flaticon-home"></i>
                </a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="#">Data Staff</a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="#">Daftar Staff</a>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">
                     <a href="?page=staff&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Tambah</a>
                  </div>
                </div>
                <div class="card-body">
                  
                      <div class="table-responsive">
                   <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Staff</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>  
                    <tfoot>
                        <tr>
                          <th>#</th>
                            <th>Nama Staff</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Opsi</th>
                        </tr>
                      </tfoot>
                    <tbody>
                        <?php 
                        $no=1;
      $staff = mysqli_query($con,"SELECT * FROM tb_staff");
                        foreach ($staff as $s) {?>
                        <tr>
                            <td><?=$no++;?>.</td>
                            <td><?=$s['nama_staff'];?></td>
                            <td><?=$s['email'];?></td>
                            <td><?php if ($s['status']=='Y') {
                                echo "<span class='badge badge-success'>Aktif</span>";
                                
                            }else {
                                echo "<span class='badge badge-danger'>Off</span>";
                            } ?></td>
                            <td><img src="../assets/img/user/<?=$s['foto'] ?>" width="45" height="45"></td>
                              <td>
              <a class="btn btn-info btn-sm" href="?page=staff&act=edit&id=<?=$s['id_staff'] ?>"><i class="far fa-edit"></i></a>
              <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=staff&act=del&id=<?=$s['id_staff'] ?>"><i class="fas fa-trash"></i>
              </a>

                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>                        
                </table>
                      </div>
                    </div>
                  </div>
                </div>



</div>
</div>






