@extends ('admin.template')

@section('leftSidebar')
	<div id="sidebar-nav" class="sidebar">
		<div class="sidebar-scroll">
			<nav>
				<ul class="nav">
					<li><a href="{{ route('admin.dashboard') }}"><i class="lnr lnr-home"></i> <span>Tableau de bord</span></a></li>
					<li><a href="{{ route('groupes.index') }}"><i class="lnr lnr-users"></i><span> Liste des clients</span></a></li>
					<li><a href="{{ route('groupes.create') }}" class="active"><i class="lnr lnr-plus-circle"></i><span> Ajouter un client</span></a></li>
					<li><a href="{{ route('users.all') }}"><i class="lnr lnr-user"></i><span> Liste des utilisateurs</span></a></li>
					<li><a href="{{ route('users.create') }}"><i class="lnr lnr-plus-circle"></i><span> Ajouter utilisateur</span></a></li>
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
				<h3 class="panel-title">Ajouter un nouveau client</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal role="form" method="POST" action="{{ route('groupes.store') }}">
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

	                <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
	                  <label for="nbrUser" class="col-sm-2 control-label">Nombre de compte</label>

	                  <div class="col-sm-10">
	                    <input type="number" class="form-control" name="nbrUser" placeholder="Saisissez le nombre de compte" value="{{ old('nbrUser') }}">

	                    @if ($errors->has('nbrUser'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nbrUser') }}</strong>
                            </span>
                        @endif

	                  </div>
	                </div>

	                <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
	                  <label for="tel" class="col-sm-2 control-label">Téléphone</label>

	                  <div class="col-sm-10">
	                    <input type="number" class="form-control" name="tel" placeholder="Saisissez le numéro de téléphone" value="{{ old('tel') }}">

	                    @if ($errors->has('tel'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tel') }}</strong>
                            </span>
                        @endif

	                  </div>
	                </div>

	                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
	                  <label for="address" class="col-sm-2 control-label">Adresse</label>

	                  <div class="col-sm-10">
	                    <input type="text" class="form-control" name="address" placeholder="Saisissez l'adresse" value="{{ old('address') }}">

	                    @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif

	                  </div>
	                </div>

	                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
	                  <label for="start_date" class="col-sm-2 control-label">Début de l'abonnement</label>

	                  <div class="col-sm-4">
	                    <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
	                  </div>
	                </div>

	                <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
	                  <label for="end_date" class="col-sm-2 control-label">Fin de l'abonnement</label>

	                  <div class="col-sm-4">
	                    <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
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

	                <!-- <div class="form-group">
	                  <label for="tel" class="col-sm-2 control-label">Mots clés</label>

	                  <div class="col-sm-10">
	                    <input type="text" value="" data-role="tagsinput" class="form-control" name="tags">
	                  </div>
	                </div> -->

	                <div class="form-group">
	                	<label for="theme" class="col-sm-2 control-label">Themes</label>
	                	<div class="col-sm-10">
	                		<ul class="list-unstyled">
								<li  style="display: block;float: left;margin-right: 16px;">
									<label class="fancy-checkbox">
										<input type="checkbox"  onClick="toggle(this)">
										<span>Tous</span>
									</label>
								</li>
								@foreach ($themes as $theme)
			                		<li style="display: block;float: left;margin-right: 16px;">
					                	<label class="fancy-checkbox">
											<input type="checkbox" name="themes[]" value="{{ $theme->id }}">
											<span>{{ $theme->name }}</span>
										</label>
									</li>
								@endforeach
							</ul>
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
	<script>
		function toggle(source) {
		  checkboxes = document.getElementsByName('themes[]');
		  for(var i=0, n=checkboxes.length;i<n;i++) {
		    checkboxes[i].checked = source.checked;
		  }
		}
	</script>
@endsection