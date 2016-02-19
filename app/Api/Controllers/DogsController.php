<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dog;
use App\Api\Requests\DogRequest;
use App\Api\Transformers\DogTransformer;

class DogsController extends BaseController
{
	/**
	 * Show all dogs
	 *
	 * Get a JSON representation of all the dogs
	 *
	 * @Get('/')
	 */
	public function index()
	{
		return $this->collection(Dog::all(), new DogTransformer);
	}

	/**
	 * Store a new dog in the database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(DogRequest $request)
	{
		return Dog::create($request->only(['name', 'age']));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return $this->response->item(Dog::findOrFail($id), new DogTransformer);
	}

	/**
	 * Update the dog in the database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(DogRequest $request, $id)
	{
		$dog = Dog::findOrFail($id);
		$dog->update($request->only(['name', 'age']));
		return $dog;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		return Dog::destroy($id);
	}
}
