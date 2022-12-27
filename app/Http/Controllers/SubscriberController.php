<?php

namespace App\Http\Controllers;

use App\DataTables\SubscriberDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Repositories\SubscriberRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Hash;
use Response;

class SubscriberController extends AppBaseController
{
    /** @var SubscriberRepository $subscriberRepository */
    private $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepo)
    {
        $this->subscriberRepository = $subscriberRepo;
    }

    /**
     * Display a listing of the Subscriber.
     *
     * @param SubscriberDataTable $subscriberDataTable
     *
     * @return Response
     */
    public function index(SubscriberDataTable $subscriberDataTable)
    {
        return $subscriberDataTable->render('subscribers.index');
    }

    /**
     * Store a newly created Subscriber in storage.
     *
     * @param CreateSubscriberRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscriberRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $subscriber = $this->subscriberRepository->create($input);

        return $this->sendSuccess('Subscriber saved successfully.');

    }

    /**
     * Display the specified Subscriber.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            Flash::error('Subscriber not found');

            return redirect(route('subscribers.index'));
        }

        return view('subscribers.show')->with('subscriber', $subscriber);
    }

    /**
     * Show the form for editing the specified Subscriber.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            Flash::error('Subscriber not found');

            return redirect(route('subscribers.index'));
        }

        return view('subscribers.edit')->with('subscriber', $subscriber);
    }

    /**
     * Update the specified Subscriber in storage.
     *
     * @param int $id
     * @param UpdateSubscriberRequest $request
     *
     * @return Response
     */
    public function update(UpdateSubscriberRequest $request, $id)
    {
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            Flash::error('Subscriber not found');

            return redirect(route('subscribers.index'));
        }
        $input = array_filter($request->all());
        if ($request->password) {
            $input['password'] = Hash::make($input['password']);
        }

        $subscriber = $this->subscriberRepository->update($input, $id);

        Flash::success('Subscriber updated successfully.');

        return redirect(route('subscribers.index'));
    }

    /**
     * Remove the specified Subscriber from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            return $this->sendError('Subscriber not found');
        }

        $this->subscriberRepository->delete($id);

        return $this->sendSuccess('Subscriber deleted successfully.');

    }
}
