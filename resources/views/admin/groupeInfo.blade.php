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

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-tagsinput.css">
@endsection

@section('content')
	<div class="panel panel-profile">
		<div class="clearfix">
			<!-- LEFT COLUMN -->
			<div class="profile-left">
				<!-- PROFILE HEADER -->
				<div class="profile-header">
					<div class="overlay"></div>
					<div class="profile-main">
						<h3 class="name">{{ $groupe->name }}</h3>
					</div>
					<div class="profile-stat">
						<div class="row">
							<div class="col-md-4 stat-item">
								{{ count($groupe->themes) }} <span>Themes</span>
							</div>
							<div class="col-md-4 stat-item">
								{{ count($sousGroupes) }} <span>Groupes créés</span>
							</div>
							<div class="col-md-4 stat-item">
								{{ count('$users') }} <span>Comptes créés</span>
							</div>
						</div>
					</div>
				</div>
				<!-- END PROFILE HEADER -->
				<!-- PROFILE DETAIL -->
				<div class="profile-detail">
					<div class="profile-info">
						<h4 class="heading">Infos du client</h4>
						<ul class="list-unstyled list-justify">
							<li>Max compte utilisateur<span>{{ $groupe->nbrUser }}</span></li>
							<li>Numéro de téléphone <span>{{ $groupe->tel }}</span></li>
							<li>Adresse <span>{{ $groupe->address }}</span></li>
						</ul>
					</div>
					<div class="profile-info">
						<h4 class="heading">Abonnement</h4>
						<ul class="list-unstyled list-justify">
							@if ($groupe->abonnement->end_date >= Carbon\Carbon::now()->toDateString())
								<li>Status<span class="label label-success">VALIDE</span></li>
							@else
								<li>Status<span class="label label-warning">NON VALIDE</span></li>
							@endif
						</ul>
					</div>
					<div class="text-center"><a href="" data-toggle="modal" data-target="#edit" class="btn btn-primary">Editer le profile</a></div>
				</div>
				<!-- END PROFILE DETAIL -->
			</div>
			<!-- LEFT COLUMN -->
			<!-- RIGHT COLUMN -->
			<div class="profile-right">
				<div class="heading">
					<a href="{{ route('client.admin',['id'=>$groupe->id]) }}" class="btn btn-default">Espace administration du client</a>
					@if ($groupe->newsletter === 0)
						<a href="{{ route('newsletters', ['id' => $groupe->id]) }}" class="btn btn-primary pull-right">Activer la newslleter</a>
					@else
						<a href="{{ route('newsletters', ['id' => $groupe->id]) }}" class="btn btn-default pull-right">Désactiver la newslleter</a>
					@endif
				</div>
				<!-- TABBED CONTENT -->
				<div class="custom-tabs-line tabs-line-bottom left-aligned">
					<ul class="nav" role="tablist">
						<li class="active"><a href="#keyword" role="tab" data-toggle="tab">Themes</a></li>
						<li><a href="#users" role="tab" data-toggle="tab">Comptes utilisateurs</a></li>
						<li><a href="#groupes" role="tab" data-toggle="tab">Groupes</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade  in active" id="keyword">
						<div class="table-responsive">
							<table class="table project-table">
								<thead>
									<tr>
										<th>Liste des themes</th>
									</tr>
								</thead>
								<tbody>
									@foreach($groupe->themes as $theme)
										<tr>
											<td>{{ $theme->name }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-pane fade" id="users">
						<div class="table-responsive">
							<table class="table project-table">
								<thead>
									<tr>
										<th>Nom</th>
										<th>E-mail</th>
										<th>Rôle</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
										<tr>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->role->name }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-pane fade" id="groupes">
						<div class="table-responsive">
							<table class="table project-table">
								<thead>
									<tr>
										<th>Nom</th>
										<th>Utilisateurs</th>
										<th>Themes</th>
									</tr>
								</thead>
								<tbody>
									@foreach($sousGroupes as $sousGroupe)
										<tr>
											<td>{{ $sousGroupe->name }}</td>
											<td>{{ count($sousGroupe->users) }}</td>
											<td></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABBED CONTENT -->
			</div>
			<!-- END RIGHT COLUMN -->

			<!-- Modal -->
			<div id="edit" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Editer le profile</h4>
			      </div>
			      <form class="form-horizontal role="form" method="POST" action="{{route('groupes.update', ['id' => $groupe->id])}}">
			      	{{ csrf_field() }}

			      	<div class="modal-body">
			      		<!-- TABBED CONTENT -->
						<div class="custom-tabs-line tabs-line-bottom left-aligned">
							<ul class="nav" role="tablist">
								<li class="active"><a href="#editBasic" role="tab" data-toggle="tab">Infos du client</a></li>
								<li><a href="#editKeyword" role="tab" data-toggle="tab">Themes</a></li>
								<li><a href="#abonnement" role="tab" data-toggle="tab">Abonnement</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade in active" id="editBasic">
									<div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
					                  <label for="tel" class="col-sm-2 control-label">Comptes</label>

					                  <div class="col-sm-10">
					                    <input type="number" class="form-control" name="nbrUser" placeholder="Saisissez le nombre de compte" value="{{ $groupe->nbrUser }}">

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
					                    <input type="number" class="form-control" name="tel" placeholder="Saisissez le numéro de téléphone" value="{{ $groupe->tel }}">

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
					                    <input type="text" class="form-control" name="address" placeholder="Saisissez l'adresse" value="{{ $groupe->address }}">

					                    @if ($errors->has('address'))
				                            <span class="help-block">
				                                <strong>{{ $errors->first('address') }}</strong>
				                            </span>
				                        @endif

					                  </div>
					                </div>
							</div>

							<div class="tab-pane fade" id="editKeyword">
								<div class="form-group">
				                  <label for="tel" class="col-sm-2 control-label">Themes</label>

				                  <div class="col-sm-10">
				                    @foreach ($themes as $theme)
				                    	@php $status = 0; @endphp

				                    	@foreach ($groupe->themes as $themeGroupe)
					                    	@if ($theme->id === $themeGroupe->id)
						                		<li style="display: block;float: left;margin-right: 16px;">
								                	<label class="fancy-checkbox">
														<input type="checkbox" name="themes[]" value="{{ $theme->id }}" checked>
														<span>{{ $theme->name }}</span>
													</label>
												</li>
												@php $status = 1; @endphp
											@endif
										@endforeach

										@if ($status === 0)
											<li style="display: block;float: left;margin-right: 16px;">
							                	<label class="fancy-checkbox">
													<input type="checkbox" name="themes[]" value="{{ $theme->id }}">
													<span>{{ $theme->name }}</span>
												</label>
											</li>
										@endif
									@endforeach
				                  </div>
				                </div>
							</div>

							<div class="tab-pane fade" id="abonnement">
								<div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
				                  <label for="end_date" class="col-sm-2 control-label">Date d'expiration</label>

				                  <div class="col-sm-4">
				                    <input type="date" class="form-control" name="end_date" value="{{ $groupe->abonnement->end_date }}">
				                  </div>
				                </div>
							</div>
						</div>
						<!-- END TABBED CONTENT -->
				    </div>
				    <div class="modal-footer">
				    	<button type="submit" class="btn btn-success">Valider les modifications</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			        </div>
			      </form>
			    </div>

			  </div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
	<script type="text/javascript" src="/js/bootstrap-tagsinput.min.js"></script>
@endsection