<?php $this->load->view('components/topbar') ?>
    <div id="layoutSidenav">
        <?php $this->load->view('components/sidebar') ?>
        <div id="layoutSidenav_content">
            <main>
                <br>
                <!-- Main page content-->
                <div class="container-xl px-4">
                    <div class="card mb-4">
                        <div class="card-header">Knowledge Category List</div>
                        <div class="card-body">
                            <a href="<?php echo base_url('knowledge_category/create') ?>"><button class="btn btn-primary" type="button">Create New</button></a><br><br>
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-primary" role="alert"><?php echo $this->session->flashdata('success'); ?></div>
                                <?php $this->session->unset_userdata('success'); ?>
                            <?php } elseif ($this->session->flashdata('warning')) { ?>
                                <div class="alert alert-warning" role="alert"><?php echo $this->session->flashdata('warning'); ?></div>
                                <?php $this->session->unset_userdata('warning'); ?>
                            <?php } ?>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Code</th>
                                        <th>Category Title</th>
                                        <th>Status</th>
                                        <th style="width:50%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($knowledge_categories as $key => $value) {
                                        $no++; ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->category_code ?></td>
                                            <td><?= $value->category_title ?></td>
                                            <td><?= check_status($value->status) ?></td>
                                            <td>
                                                <a href="<?php echo base_url('knowledge_category/show/'); echo $value->id; ?>"><button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></button></a>
                                                <a href="<?php echo base_url('knowledge_category/edit/'); echo $value->id; ?>"><button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="edit"></i></button></a>
                                                <a href="#"><button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $value->id; ?>"><i data-feather="trash-2"></i></button></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="exampleModal<?php echo $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Cofirm</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">Are you sure to delete this data?</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                                        <a href="<?php echo base_url('knowledge_category/destroy/'); echo $value->id; ?>"><button class="btn btn-danger" type="button">Delete Data</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php $this->load->view('components/footer') ?>
        </div>
    </div>