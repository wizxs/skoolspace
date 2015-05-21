<?php namespace App\Http\Controllers;

use App\Http\CLient\ClientRepository;
use App\Http\Group\GroupRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateSchoolRequest;
use App\Http\User\UserRepository;
use App\User;
use Illuminate\Http\Request;


class GroupController extends Controller {

    protected $clientRepo;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ClientRepository|GroupRepository
     */
    private $repo;


    /**
     * @param ClientRepository $clientRepository
     * @param UserRepository $userRepository
     * @param ClientRepository|GroupRepository $repo
     */
    function __construct(ClientRepository $clientRepository, UserRepository $userRepository, GroupRepository $repo)
    {
        $this->clientRepo = $clientRepository;
        $this->userRepository = $userRepository;
        $this->repo = $repo;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $title = "Groups";
        $groups = $this->groupsForUser();
        return view('school.inspina.schools', compact('title', 'groups'));
	}

	/**
	 * Show the form for creating a new Group
	 *
	 * @return Response
	 */
	public function create()
	{
        $title = 'New School';

        return view('school.inspina.create', compact('title'));
	}

    /**
     * Store a newly created group to the database.
     *
     * @param CreateSchoolRequest $request
     * @internal param $school
     * @return Response
     */
	public function store(CreateSchoolRequest $request)
	{

        $user = $this->user();
        $group = $user->groups()->create($request->all());
        $this->clientRepo->clientJoin($group, $user);
        return redirect($group->username);
	}

    /**
     * Display the specified resource.
     *
     * @param $group
     * @internal param int $id
     * @return Response
     */
	public function show($group)
	{
        $title = $group->name;
        return view('inspina.profile.school' , compact('title','group'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $group
     * @internal param int $id
     * @return Response
     */
	public function edit($group)
	{
        $title = $group->name;
        return view('inspina.update.school', compact('title', 'group'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $group
     * @internal param int $id
     * @return Response
     */
	public function update(Request $request, $group)
	{
        if ($request->file('profile') != null)
        {
            $name = $_FILES['profile']['name'];
            $tmpName = $_FILES['profile']['tmp_name'];
            $location = 'uploads/images/profile/';
            $type = $request->file('profile')->getClientOriginalExtension();
            $destination = $location . $name;
            if (move_uploaded_file($tmpName, $destination)) {

                $group->fill($request->input())->save();
                $group->profile()->delete();
                $group->profile()->create([
                    'name' => $name,
                    'type' => $type,
                    'source' => $destination
                ]);

                return redirect($group->username)->with('success', 'Profile successfully updated');
            }
            return redirect($group->username)->with('error', 'File has not been uploaded');
        }
        $group->fill($request->input())->save();
        return redirect($group->username);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $group
     * @internal param int $id
     * @return Response
     */
	public function destroy($group)
	{
        $group->delete();
        return redirect('/admin/groups');
	}

    public function  allGroups()
    {
        $title = "Your Groups";
        $groups = $this->clientRepo->groupsForUser($this->user());
        return view('inspina.index.allGroups', compact('title', 'groups'));
    }

    /**
     * @param $group
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateAdministrator($group, Request $request)
    {
        $user = $this->userRepository->FindByEmail($request->email);

        #Checks whether the user is a member of skoolspace
        if(!$user)
            return redirect()->back()->withErrors('This is not a member of skoolspace');

        #Checks whether the user is a member of the group
        if(!$this->repo->isFollowerOf($group, $user))
            return redirect()->back()->withErrors('This is not a member of '. $group->name);

        #Changes the administrator to the new user.
        $group->user_id = $user->id;
        $group->save();
        return redirect($group->username);
    }
}
