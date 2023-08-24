<?= $this->extend('template/admin_template'); ?>

<?= $this->section('content'); ?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Office Management</h1>
      </div>
      <!-- /.col -->
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <button type="button" id="addrow" data-toggle="modal" data-target="#modelId" class="btn btn-primary" onclick="clearform()">
          Add Office
        </button>
      </div>
    </div>
    <table id="dataTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Code</th>
          <th scope="col">Description</th>
        </tr>
      </thead>
      <!-- Modal -->
    </table>

    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New Office</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate>
              <input type="hidden" name="id" id="id" />
              <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter a Name.</div>
              </div>
              <div class="form-group">
                <label for="code">Code *</label>
                <input type="text" class="form-control" name="code" id="code" placeholder="Code" required />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter a Code.</div>
              </div>
              <div class="form-group">
                <label for="description">Description *</label>
                <textarea type="textarea" class="form-control" name="description" id="description" rows="5" minlength="10" required></textarea>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Description is Required. Minimum length is 10 characters.</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary" id="save">
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="deleteprompt" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
              You are about to delete this record with ID
              <span id="itemtodelete"></span>.
            </p>
            <input type="hidden" id="deleteid" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary" onclick="deleteProfile()">
              Confirm
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(function() {
    $("form").submit(function(event) {
      event.preventDefault();
      let formdata = $(this).serializeArray();
      if (this.checkValidity()) {
        if (!formdata[0].value) {
          //create
          $.ajax({
            method: "POST",
            url: "<?= base_url() ?>api/office", 
            data: formdata,
            success: function(result, textStatus, jqXHR) {
              console.log(textStatus + ": " + jqXHR.status);
              $(document).Toasts("create", {
                class: "bg-success",
                title: "Success",
                body: "Records Created Successfuly.",
                autohide: true,
                delay: 3000,
              });
              clearform();
              table.ajax.reload();
              $("#modelId").modal("hide");
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
              $(document).Toasts("create", {
                class: "bg-danger",
                title: "Error",
                body: "Records Was Not Created.",
                autohide: false,
                delay: 3000,
              });
            },
          });
        } else {
          $.ajax({
            method: "PUT",
            url: "<?= base_url() ?>api/office/" + formdata[0].value ,
            data: formdata,
            success: function(result, textStatus, jqXHR) {
              console.log(textStatus + ": " + jqXHR.status);
              $(document).Toasts("create", {
                class: "bg-success",
                title: "Success",
                body: "Records Updated Successfuly.",
                autohide: true,
                delay: 3000,
              });
              clearform();
              table.ajax.reload();
              $("#modelId").modal("hide");

            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
              $(document).Toasts("create", {
                class: "bg-danger",
                title: "Error",
                body: "Records Was Not Updated.",
                autohide: true,
                delay: 3000,
              });
            },
          });
        }
        $(this).addClass("was-validated");
      }


    });

    $(document).on("click", "#editRow", function() {
      let row = $(this).parents("tr")[0];
      let id = table.row(row).data().id;
      $.ajax({
        method: "GET",
        url: "<?= base_url() ?>api/office/" + id,
        success: function(result, textStatus, jqXHR) {
          console.log(textStatus + ": " + jqXHR.status);
          $("#modelId").modal("show");
          $("#id").val(result.id);
          $("#name").val(result.name);
          $("#code").val(result.code);
          $("#description").val(result.description);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
        },
      });
    });

    $(document).on("click", "#deleteRow", function() {
      let row = $(this).parents("tr")[0];
      let id = table.row(row).data().id;
      $("#deleteid").val(id);
      $("#itemtodelete").text(id);
      $("#deleteprompt").modal("show");
    });
  });

  var table = $("#dataTable").DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: "<?= base_url() ?>api/office/list",
      type: "POST",
    },
    columns: [{
        data: "id"
      },
      {
        data: "name"
      },
      {
        data: "code"
      },
      {
        data: "description"
      },
      {
        data: null,
        defaultContent: `<td>
                <button class="btn btn-primary" id="editRow">Edit</button>
                <button class="btn btn-danger" data-toggle="modal" id="deleteRow">Delete</button>
              </td>`,
      },
    ],
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: false,
    info: true,
    autoWidth: false,
    lengthMenu: [5, 10, 25, 50],
  });

  function deleteProfile() {
    $("#deleteprompt").modal("hide");
    let id = $("#deleteid").val();
    $.ajax({
      method: "DELETE",
      url: "<?= base_url() ?>api/office/" + id,
      success: function(result, textStatus, jqXHR) {
        console.log(textStatus + ": " + jqXHR.status);
        $(document).Toasts("create", {
          class: "bg-success",
          title: "Success",
          body: "Records Deleted Successfuly.",
          autohide: true,
          delay: 3000,
        });
        table.ajax.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
      },
    });
  }

  function clearform() {
    $("#id").val("");
    $("#name").val("");
    $("#code").val("");
    $("#description").val("");
  }

  $(document).ready(function() {
    'use strict';
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = $('.needs-validation');
    // Loop over them and prevent submission
    forms.each(function() {
      $(this).on('submit', function(event) {
        if (this.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        $(this).addClass('was-validated');
      });
    });
  });
</script>
<?= $this->endSection(); ?>