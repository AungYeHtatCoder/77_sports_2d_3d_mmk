@extends('layouts.admin_app')
@section('styles')
<style>
.transparent-btn {
 background: none;
 border: none;
 padding: 0;
 outline: none;
 cursor: pointer;
 box-shadow: none;
 appearance: none;
 /* For some browsers */
}
</style>
@endsection
@section('content')
<div class="row mt-4">
 <div class="col-12">
  <div class="card">
   <!-- Card header -->
   <div class="card-header pb-0">
    <div class="d-lg-flex">
     <div>
      <h5 class="mb-0">User Dashboards</h5>

     </div>
     <div class="ms-auto my-auto mt-lg-0 mt-4">
      <div class="ms-auto my-auto">
       <a href="{{ route('admin.users.create') }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Create New
        User</a>
       <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button"
        name="button">Export</button>
      </div>
     </div>
    </div>
   </div>
   <div class="table-responsive">
    <table class="table table-flush" id="users-search">
     <thead class="thead-light">
      <th>#</th>
      <th>UserName</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Balance</th>
      <th>Created_at</th>
      <th>Action</th>
     </thead>
     <tbody>
      @foreach ($users as $key => $user)
      <tr>
       <td class="text-sm font-weight-normal">{{ ++$key }}</td>
       <td class="text-sm font-weight-normal">{{ $user->name }}</td>
       <td class="text-sm font-weight-normal">{{ $user->email }}</td>
       <td class="text-sm font-weight-normal">{{ $user->phone }}</td>
       <td class="text-sm font-weight-normal">{{ $user->balance }}</td>
       <td class="text-sm font-weight-normal">{{ $user->created_at->format('F j, Y') }}</td>
       <td>
        {{-- <a href="{{ route('admin.users.edit', $user->id) }}" data-bs-toggle="tooltip"
         data-bs-original-title="Edit User"><i
          class="material-icons-round text-secondary position-relative text-lg">mode_edit</i></a> --}}
        <a href="{{ route('admin.two-d-users-details', $user->id) }}" data-bs-toggle="tooltip"
         data-bs-original-title="Preview User Detail">
         <i class="material-icons text-secondary position-relative text-lg">visibility</i>
        </a>
        {{-- <form class="d-inline" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
         @csrf
         @method('DELETE')
         <button type="submit" class="transparent-btn" data-bs-toggle="tooltip" data-bs-original-title="Delete User">
          <i class="material-icons text-secondary position-relative text-lg">delete</i>
         </button>

        </form> --}}
       </td>
      </tr>
      @endforeach
     </tbody>
    </table>
   </div>
  </div>
 </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
{{-- <script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
  </script> --}}
<script>
if (document.getElementById('users-search')) {
 const dataTableSearch = new simpleDatatables.DataTable("#users-search", {
  searchable: true,
  fixedHeight: false,
  perPage: 7
 });

 document.querySelectorAll(".export").forEach(function(el) {
  el.addEventListener("click", function(e) {
   var type = el.dataset.type;

   var data = {
    type: type,
    filename: "material-" + type,
   };

   if (type === "csv") {
    data.columnDelimiter = ",";
   }

   dataTableSearch.export(data);
  });
 });
};
</script>
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
 return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
@endsection