@extends ('layouts.admin')

@section('leftSidebar')
	
@endsection

@section('content')
	
	<div class="custom-tabs-line tabs-line-bottom" align="center">
		<ul class="nav" role="tablist">
			<li class="active"><a href="#dashboard" role="tab" data-toggle="tab">Tableau de board</a></li>
			<li><a href="#groupe" role="tab" data-toggle="tab">Créer un groupe</a></li>
			<li><a href="#user" role="tab" data-toggle="tab">Créer un compte utlisisateur</a></li>
		</ul>
	</div>

	<div class="tab-content">
		<!-- VUE D'ENSEMBLE -->
		<div class="tab-pane fade in active" id="dashboard">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Tableau de bord</h3>
					<!--
					@php
						$monday = new Carbon\Carbon('last monday');
					@endphp
					<p class="panel-subtitle">Période: {{ $monday->toFormattedDateString() }} - {{ Carbon\Carbon::now()->toFormattedDateString() }}</p>-->
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="fa fa-users"></i></span>
								<p>
									<span class="number">{{ count($sousGroupes) }}</span>
									<span class="title">Goupes</span>
								</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="fa fa-user"></i></span>
								<p>
									<span class="number">{{ count($users) }}</span>
									<span class="title">Comptes utilisateurs</span>
								</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="fa fa-file-text"></i></span>
								<p>
									<span class="number">{{ $groupe->nbrUser }}</span>
									<span class="title">Comptes maximum</span>
								</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="fa fa-key"></i></span>
								<p>
									<span class="number">{{ count($groupe->keywords) }}</span>
									<span class="title">Mots clés</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- FIN VUE D'ENSEMBLE -->

			<div class="row">
				<div class="col-md-9">
					<!-- GROUPE LIST -->
					<div class="panel col-md-12">
						<div class="panel-heading">
							<h3 class="panel-title">Liste des groupes</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
								<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
							</div>
						</div>
						<div class="panel-body table-responsive">
							@if(count($sousGroupes))
								<table class="table table-hover centered" id="myTable">
									<thead>
										<tr>
											<th>Nom</th>
											<th>Mots clés</th>
											<th>Nombre d'utilisateur</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($sousGroupes as $sousGroupe)
											<tr>	
												<td>{{ $sousGroupe->name }}</td>
												<td>{{ $sousGroupe->keywords }}</td>
												<td>{{ count($sousGroupe->users) }}</td>
												<td>
													<a href="{{ route('sousGroupes.destroy', ['id' => $sousGroupe->id]) }}" class="btn btn-danger btn-xs btn-toastr"><i class="fa fa-trash fa-faw"></i></a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@else
								<span>Aucun groupe n'a été créé</span>
							@endif
						</div>
					</div>
					<!-- END GROUPE LIST -->

					<!-- USER LIST -->
					<div class="panel col-md-12">
						<div class="panel-heading">
							<h3 class="panel-title">Liste des comptes utilisateurs</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
								<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
							</div>
						</div>
						<div class="panel-body table-responsive">
							@if (count($sousGroupes) && count($sousGroupe->users))
								<table class="table table-hover centered" id="myTable">
									<thead>
										<tr>
											<th>Nom</th>
											<th>E-mail</th>
											<th>Groupe</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($sousGroupes as $sousGroupe)
												@foreach ($sousGroupe->users()->get() as $user)
													<tr>	
														<td>{{ $user->name }}</td>
														<td>{{ $user->email }}</td>
														<td>{{ $sousGroupe->name }}</td>
														<td>
															<a href="{{ route('users.destroy', ['id' => $user->id]) }}" class="btn btn-danger btn-xs btn-toastr"><i class="fa fa-trash fa-faw"></i></a>
														</td>
													</tr>
												@endforeach
										@endforeach
									</tbody>
								</table>
							@else
								<span>Aucun compte utilisateur n'a été créé</span>
							@endif
						</div>
					</div>
					<!-- END USER LIST -->
				</div>
				<div class="col-md-3">
					<!-- TIMELINE -->
					<div class="panel panel-scrolling">
						<div class="panel-heading">
							<h3 class="panel-title">Mot clés</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
								<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
							</div>
						</div>
						<div class="panel-body">
							<ul class="list-unstyled">
								@foreach ($groupe->keywords as $keyword)
									<li><span>{{ $keyword->name }}</span>
								@endforeach
							</ul>
						</div>
					</div>
					<!-- END TIMELINE -->
				</div>
			</div>
		</div>

		<!-- GROUPE -->
		<div class="tab-pane fade" id="groupe">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Créer un groupe</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal role="form" method="POST" action="{{ route('sousGroupes.store') }}">
						{{ csrf_field() }}

		                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		                  <label for="name" class="col-sm-2 col-sm-offset-2 control-label">Nom</label>

		                  <div class="col-sm-5">
		                    <input type="text" class="form-control" name="name" placeholder="Saisissez le nom" value="{{ old('name') }}" required>

		                    @if ($errors->has('name'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('name') }}</strong>
		                        </span>
		                    @endif

		                  </div>
		                </div>

		                <input type="hidden" name="groupe_id" value="{{ $groupe->id }}">

		                <div class="form-group">
							<div class="panel panel-scrolling col-sm-3 col-sm-offset-5">
								<div class="panel-heading">
									<h5 class="panel-title">Liste des mots clés</h5>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled">
										@foreach ($groupe->keywords as $keyword)
					                		<li class="">
							                	<label class="fancy-checkbox">
													<input type="checkbox" name="tags[]" value="{{ $keyword->name }}">
													<span>{{ $keyword->name }}</span>
												</label>	
											</li>
										@endforeach
									</ul>
								</div>
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
		<!-- END GROUPE -->

		<!-- OXDATA -->
		<div class="tab-pane fade" id="user">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Créer un compte utilisateur</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal role="form" method="POST" action="{{ route('register') }}">
						{{ csrf_field() }}

		                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		                  <label for="name" class="col-sm-2 col-sm-offset-2 control-label">Nom</label>

		                  <div class="col-sm-6">
		                    <input type="text" class="form-control" name="name" placeholder="Saisissez le nom" value="{{ old('name') }}" required>

		                    @if ($errors->has('name'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('name') }}</strong>
		                        </span>
		                    @endif

		                  </div>
		                </div>

		                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		                  <label for="email" class="col-sm-2 col-sm-offset-2 control-label">E-mail</label>

		                  <div class="col-sm-6">
		                    <input type="email" class="form-control" name="email" placeholder="Saisissez l'e-mail" value="{{ old('email') }}" required>

		                    @if ($errors->has('email'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('email') }}</strong>
		                        </span>
		                    @endif

		                  </div>
		                </div>

		                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		                  <label for="password" class="col-sm-2 col-sm-offset-2 control-label">Mot de passe</label>

		                  <div class="col-sm-6">
		                    <input type="password" class="form-control" name="password" placeholder="Saisissez le mot de passe" required>

		                    @if ($errors->has('password'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('password') }}</strong>
		                        </span>
		                    @endif

		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="password_confirmation" class="col-sm-2 col-sm-offset-2 control-label">Confirmer</label>

		                  <div class="col-sm-6">
		                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirner mot de passe" required>
		                  </div>
		                </div>

		                <input type="hidden" name="groupe_id" value="{{ $groupe->id }}">

		                <div class="form-group">
		                  <label for="role" class="col-sm-2 col-sm-offset-2 control-label">Groupe</label>

		                  <div class="col-sm-4">
		                    <select class="form-control" name="sous_groupe_id" required>
		                    	<option disabled>--Selectionnez un groupe--</option>
		                    	@if (count($sousGroupes))
			                    	@foreach ($sousGroupes as $sousGroupe)
			                    		<option value="{{ $sousGroupe->id }}">{{ $sousGroupe->name }}</option>
			                    	@endforeach
		                    	@endif
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
		<!-- END OXDATA -->
	</div>
		
@endsection

@section('javascript')
	
@endsection