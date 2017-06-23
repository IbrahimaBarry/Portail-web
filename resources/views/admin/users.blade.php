@extends ('admin.template')

@section('leftSidebar')
	<div id="sidebar-nav" class="sidebar">
		<div class="sidebar-scroll">
			<nav>
				<ul class="nav">
					<li><a href="{{ route('admin.dashboard') }}"><i class="lnr lnr-home"></i> <span>Tableau de bord</span></a></li>
					<li><a href="{{ route('groupes.index') }}"><i class="lnr lnr-users"></i><span> Liste des clients</span></a></li>
					<li><a href="{{ route('groupes.create') }}"><i class="lnr lnr-plus-circle"></i><span> Ajouter un client</span></a></li>
					<li><a href="{{ route('users.all') }}" class="active"><i class="lnr lnr-user"></i><span> Liste des utilisateurs</span></a></li>
					<li><a href="{{ route('users.create') }}"><i class="lnr lnr-plus-circle"></i><span> Ajouter utilisateur</span></a></li>
					<li><a href="{{ route('admin.theme') }}"><i class="lnr lnr-tag"></i> <span>Gestion des themes</span></a></li>
				</ul>
			</nav>
		</div>
	</div>
@endsection

@section('content')
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Liste des comptes utilisateurs</h3><br>
				<div class="row">
					<form class="pull-right">
						<div class="input-group">
							<input type="text" value="" class="form-control" id="myInput" onkeyup="filtrer()" placeholder="Rechercher par nom">
						</div>
					</form>
				</div>
			</div>
			<div class="panel-body table-responsive">
				<table class="table table-hover centered" id="myTable">
					<thead>
						<tr>
							<th>Nom</th>
							<th>E-Mail</th>
							<th>Client</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							@if ($user->groupe->id === 1)
								<tr class="active">
									<td>{{ $user->name }}</a>
									</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->groupe->name }}</td>
									<td>
										<a href="{{ route('users.destroy', ['id' => $user->id]) }}" class="btn btn-danger btn-xs btn-toastr"><i class="fa fa-trash fa-faw"></i></a>
									</td>
								</tr>
							@else
								<tr>	
									<td>{{ $user->name }}</a>
									</td>
									<td>{{ $user->email }}</td>
									<td>
										<a href="{{ route('groupes.show', ['id' => $user->groupe->id]) }}">
											{{ $user->groupe->name }}
										</a>
									</td>
									<td>
										<a href="{{ route('users.destroy', ['id' => $user->id]) }}" class="btn btn-danger btn-xs btn-toastr"><i class="fa fa-trash fa-faw"></i></a>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
	function filtrer() {
	  var input, filter, table, tr, td, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable");
	  tr = table.getElementsByTagName("tr");
	  for (i = 0; i < tr.length; i++) {
	    td = tr[i].getElementsByTagName("td")[0];
	    if (td) {
	      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
	        tr[i].style.display = "none";
	      }
	    }       
	  }
	}
	</script>
@endsection