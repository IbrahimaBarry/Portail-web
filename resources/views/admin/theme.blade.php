@extends ('admin.template')

@section('leftSidebar')
	<div id="sidebar-nav" class="sidebar">
		<div class="sidebar-scroll">
			<nav>
				<ul class="nav">
					<li><a href="{{ route('admin.dashboard') }}"><i class="lnr lnr-home"></i> <span>Tableau de bord</span></a></li>
					<li><a href="{{ route('groupes.index') }}"><i class="lnr lnr-users"></i><span> Liste des clients</span></a></li>
					<li><a href="{{ route('groupes.create') }}"><i class="lnr lnr-plus-circle"></i><span> Ajouter un client</span></a></li>
					<li><a href="{{ route('users.all') }}"><i class="lnr lnr-user"></i><span> Liste des utilisateurs</span></a></li>
					<li><a href="{{ route('users.create') }}"><i class="lnr lnr-plus-circle"></i><span> Ajouter utilisateur</span></a></li>
					<li><a href="{{ route('themes.index') }}" class="active"><i class="lnr lnr-tag"></i> <span>Gestion des themes</span></a></li>
				</ul>
			</nav>
		</div>
	</div>
@endsection

@section('content')
	<div class="col-md-7">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Gestion des themes</h3><br>
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
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($themes as $theme)
							<tr>
								<td>{{ $theme->name }}</td>
								<td>
									<a href="{{ route('themes.show', ['id' => $theme->id]) }}" class="btn btn-info btn-xs btn-toastr"><i class="fa fa-eye fa-faw"></i></a>
									<a href="{{ route('themes.destroy', ['id' => $theme->id]) }}" class="btn btn-danger btn-xs btn-toastr"><i class="fa fa-trash fa-faw"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">
					<a href="" data-toggle="modal" data-target="#edit" class="btn btn-primary">Ajouter un theme</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-5 text-center">
		<div class="panel panel-scrolling">
			<div class="panel-body">
				<h2 style="margin-top: 120px; color: #bdbdbd">Aucun theme sélectionné</h2>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div id="edit" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Ajouter un theme</h4>
	      </div>
	      <form class="form-horizontal role="form" method="POST" action="{{route('themes.store')}}">
	      	{{ csrf_field() }}

	      	<div class="modal-body">

	      		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-sm-3 control-label">Nom du theme</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="name" placeholder="Saisissez le nom du theme" value="{{ old('name') }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

                  </div>
                </div>

                <div class="form-group">
                  <label for="tel" class="col-sm-3 control-label">Mots clés</label>

                  <div class="col-sm-9">
                    <input type="text" value="" data-role="tagsinput" class="form-control" name="tags">
                  </div>
                </div>

		    </div>
		    <div class="modal-footer">
		    	<button type="submit" class="btn btn-success">Ajouter</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	        </div>
	      </form>
	    </div>

	  </div>
	</div>
@endsection

@section('javascript')
	<script type="text/javascript" src="/js/bootstrap-tagsinput.min.js"></script>

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