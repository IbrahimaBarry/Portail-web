@extends ('admin.template')

@section('leftSidebar')
	<div id="sidebar-nav" class="sidebar">
		<div class="sidebar-scroll">
			<nav>
				<ul class="nav">
					<li><a href="{{ route('admin.dashboard') }}"><i class="lnr lnr-home"></i> <span>Tableau de bord</span></a></li>
					<li><a href="{{ route('groupes.index') }}" class="active"><i class="lnr lnr-users"></i><span> Liste des clients</span></a></li>
					<li><a href="{{ route('groupes.create') }}"><i class="lnr lnr-plus-circle"></i><span> Ajouter un client</span></a></li>
					<li><a href="{{ route('users.all') }}"><i class="lnr lnr-user"></i><span> Liste des utilisateurs</span></a></li>
					<li><a href="{{ route('users.create') }}"><i class="lnr lnr-plus-circle"></i><span> Ajouter utilisateur</span></a></li>
					<li><a href="{{ route('themes.index') }}"><i class="lnr lnr-tag"></i> <span>Gestion des themes</span></a></li>
				</ul>
			</nav>
		</div>
	</div>
@endsection

@section('content')
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Liste des clients</h3><br>
				<div class="row">
					<form class="pull-right">
						<div class="input-group">
							<input type="text" value="" class="form-control" id="myInput" onkeyup="filtrer()" placeholder="Rechercher par nom">
						</div>
					</form>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-hover" id="myTable">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Nombre d'utilisateur</th>
							<th>Téléphone</th>
							<th>Adresse</th>
							<th>Status abonnement</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($groupes as $groupe)
							<tr>
								<td>
									<a href="{{ route('groupes.show', ['id' => $groupe->id]) }}">{{ $groupe->name }}</a>
								</td>
								<td>{{ count($groupe->users) }} / {{ $groupe->nbrUser }}</td>
								<td>{{ $groupe->tel }}</td>
								<td>{{ $groupe->address }}</td>
								@if ($groupe->abonnement->end_date >= Carbon\Carbon::now()->toDateString())
									<td><span class="label label-success">VALIDE</span></td>
								@else
									<td><span class="label label-warning">NON VALIDE</span></td>
								@endif
								<td>
									<a href="{{ route('groupes.show', ['id' => $groupe->id]) }}" class="btn btn-info btn-xs btn-toastr"><i class="fa fa-eye fa-faw"></i></a>
									<a href="{{ route('groupes.destroy', ['id' => $groupe->id]) }}" class="btn btn-danger btn-xs btn-toastr"><i class="fa fa-trash fa-faw"></i></a>
								</td>
							</tr>
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