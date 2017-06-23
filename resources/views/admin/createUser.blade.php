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
					<li><a href="{{ route('users.create') }}" class="active"><i class="lnr lnr-plus-circle"></i><span> Ajouter utilisateur</span></a></li>
					<li><a href="{{ route('themes.index') }}"><i class="lnr lnr-tag"></i> <span>Gestion des themes</span></a></li>
				</ul>
			</nav>
		</div>
	</div>
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-tagsinput.css">
@endsection

@section('content')
	<div class="col-md-9 col-md-offset-1">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Ajouter un utilisateur</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal role="form" method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}

	                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                  <label for="name" class="col-sm-2 control-label">Nom</label>

	                  <div class="col-sm-10">
	                    <input type="text" class="form-control" name="name" placeholder="Saisissez le nom" value="{{ old('name') }}" required>

	                    @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

	                  </div>
	                </div>

	                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                  <label for="email" class="col-sm-2 control-label">E-mail</label>

	                  <div class="col-sm-10">
	                    <input type="email" class="form-control" name="email" placeholder="Saisissez l'e-mail" value="{{ old('email') }}" required>

	                    @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

	                  </div>
	                </div>

	                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                  <label for="password" class="col-sm-2 control-label">Mot de passe</label>

	                  <div class="col-sm-10">
	                    <input type="password" class="form-control" name="password" placeholder="Saisissez le mot de passe" required>

	                    @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="password_confirmation" class="col-sm-2 control-label">Confirmer</label>

	                  <div class="col-sm-10">
	                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirner mot de passe" required>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="role" class="col-sm-2 control-label">Groupe</label>

	                  <div class="col-sm-4">
	                    <select class="form-control" name="groupe_id" required>
	                    	<option disabled>--Selectionnez un groupe--</option>
	                    	@foreach ($groupes as $groupe)
	                    		<option value="{{ $groupe->id }}">{{ $groupe->name }}</option>
	                    	@endforeach
	                    </select>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="role" class="col-sm-2 control-label">Rôle</label>

	                  <div class="col-sm-4">
	                    <select class="form-control" name="role_id" required>
	                    	<option disabled>--Selectionnez un role--</option>
	                    	<option value="1">Super Admin</option>
	                    	<option value="2">Admin</option>
	                    	<option value="3">Utilisateur</option>
	                    </select>
	                  </div>
	                </div>

	                <div class="form-group">
	                    <div class="col-md-6 col-md-offset-4">
	                        <button type="submit" class="btn btn-primary btn-toastr">Ajouter</button>
	                        <button type="reset" class="btn btn-danger btn-toastr">Effacer</button>
	                    </div>
                	</div>
            	</form>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
	<script type="text/javascript" src="/js/bootstrap-tagsinput.min.js"></script>
@endsection