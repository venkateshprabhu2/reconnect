<?php

class EventsController extends \BaseController {

	/**
	 * Display a listing of events
	 *
	 * @return Response
	 */
	public function index()
	{
		$events = Event::all();
		return View::make('events.index', compact('events'));
	}

	/**
	 * Show the form for creating a new event
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('events.create');
	}

	/**
	 * Store a newly created event in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Event::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['creator_id'] = Auth::id();
		$guest_list =array();
		$data['guest_list']= json_encode($guest_list);
		// var_dump($guest_list);

		Event::create($data);

		return Redirect::route('events.index');
	}

	/**
	 * Display the specified event.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$event = Event::findOrFail($id);
		$creator = User::find($event->creator_id);

		return View::make('events.show', compact('event', 'creator'));
	}

	/**
	 * Show the form for editing the specified event.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$event = Event::find($id);

		return View::make('events.edit', compact('event'));
	}

	/**
	 * Update the specified event in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$event = Event::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Event::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$event->update($data);

		return Redirect::route('events.index');
	}

	/**
	 * Remove the specified event from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Event::destroy($id);

		return Redirect::route('events.index');
	}
	public function join($id)
	{
		$event = Event::findOrFail($id);
		$guest_list = json_decode($event->guest_list);
		$userid = Auth::id();
		var_dump($guest_list);
		if($guest_list != null){
			if(in_array($userid, $guest_list)){}
			else{
				$guest_list[] = $userid;
			}
		}
		else{
			$guest_list[] = $userid;
		}
		var_dump($guest_list);
		var_dump(json_encode($guest_list));
		$event->guest_list = json_encode($guest_list);
		$event->save();
		return Redirect::route('events.show',$event->id);

	}

}
