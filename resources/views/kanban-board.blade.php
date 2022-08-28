@extends('master-blade.master')

@section('body-content')

				<div class="container">

					<div class="card card-custom">
						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">Kanban Board</h3>
							</div>
						</div>
						<div class="card-body">

							<div class="kanban-form">
								<form id="taskForm">
									@csrf
									<div class="form-group">
									  <input type="text" name="task_description" id="task" placeholder="Write your task...">
									  <button type="submit" class="task-add-btn">Add</button>
									</div>
								</form>
							</div>

							<div>
								<div class="kanban-container">

									<div class="container">

									

									<div class="row">
										<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
											<div class="kanban-board" id="to-do">
												<header class="kanban-board-header">
													<div class="kanban-title-board">To Do</div>
												</header>
												<main class="kanban-drag">

													@foreach($toDoTasks as $tdt)
												
														<div class="kanban-item" id="to-do-{{ $tdt->TASK_ID }}">
														
															<div class="dropdown">
																<i class="fa-solid fa-ellipsis"></i>
																<div class="dropdown-content">
																	<a href="javascript:void(0)" data-id="{{ $tdt->TASK_ID }}" data-status="{{ $tdt->STATUS }}" data-url="{{ route('task.ajaxUpdate') }}" class="change-status-to-in-progress">In-Progress</a>
																	<a href="javascript:void(0)" data-id="{{ $tdt->TASK_ID }}" data-status="{{ $tdt->STATUS }}" data-url="{{ route('task.ajaxUpdate') }}" class="change-status-to-done">Done</a>
																	<a href="javascript:void(0)" data-id="{{ $tdt->TASK_ID }}" data-status="{{ $tdt->STATUS }}" data-url="{{ route('task.ajaxDelete',$tdt->TASK_ID) }}" class="delete-task">Delete</a>
																</div>
															</div>
															<span class="font-weight-bold">{{ $tdt->DESCRIPTION }}</span>
															

														</div>

													@endforeach

													
												</main>
												<footer></footer>
											</div>
										</div>

										<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
											<div class="kanban-board" id="in-progress">
												<header class="kanban-board-header">
													<div class="kanban-title-board">In Progress</div>
												</header>
												<main class="kanban-drag">

													@foreach($inProgressTasks as $ipt)
														
														<div class="kanban-item" id="in-progress-{{ $ipt->TASK_ID }}">
															<div class="dropdown">
																<i class="fa-solid fa-ellipsis"></i>
																<div class="dropdown-content">
																	<a href="javascript:void(0)" data-id="{{ $ipt->TASK_ID }}" data-status="{{ $ipt->STATUS }}" data-url="{{ route('task.ajaxUpdate') }}" class="change-status-to-done">Done</a>
																	<a href="javascript:void(0)" data-id="{{ $ipt->TASK_ID }}" data-status="{{ $ipt->STATUS }}" data-url="{{ route('task.ajaxDelete',$ipt->TASK_ID) }}" class="delete-task">Delete</a>
																</div>
															</div>
															<span class="font-weight-bold">{{ $ipt->DESCRIPTION }}</span>

														</div>

													@endforeach

												</main>
												<footer></footer>
											</div>
										</div>

										<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
											<div class="kanban-board" id="done">
												<header class="kanban-board-header">
													<div class="kanban-title-board">Done</div>
												</header>
												<main class="kanban-drag">

													@foreach($doneTasks as $dt)
													
														<div class="kanban-item" id="done-{{ $dt->TASK_ID }}">
															<div class="dropdown">
																<i class="fa-solid fa-ellipsis"></i>
																<div class="dropdown-content">
																	<a href="javascript:void(0)" data-id="{{ $dt->TASK_ID }}" data-status="{{ $dt->STATUS }}" data-url="{{ route('task.ajaxDelete',$dt->TASK_ID) }}" class="delete-task">Delete</a>
																</div>
															</div>
															<span class="font-weight-bold">{{ $dt->DESCRIPTION }}</span>

														</div>

													@endforeach


												</main>
												<footer></footer>
											</div>
										</div>
										
									</div>
									
									
									</div>
									

									

								</div>
							</div>

						</div>
					</div>
	
				</div>

@endsection
				
		