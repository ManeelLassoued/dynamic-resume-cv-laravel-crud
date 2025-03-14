<?php

namespace App\Http\Controllers;

use App\Models\ContactInformation;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Interests;
use App\Models\Languages;
use App\Models\PersonalInformation;
use App\Models\Projects;
use App\Models\Skills;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $user = auth()->id();
        $personal_information = PersonalInformation::get()->toArray();
        if (!empty($personal_information)) {

            $user_data = array();
            foreach ($personal_information as $personal_info) {

                $personal_info_id = $personal_info['id'];

                if (!empty($personal_info_id)) {
                    $user_info['personal_info']         = $personal_info;


                    $contact_info                       = ContactInformation::find($personal_info_id);
                    if (!empty($contact_info)) {

                        $user_info['contact_info']      = $contact_info->toArray();
                    }

                    $education_info                     = Education::find($personal_info_id);
                    if (!empty($education_info)) {
                        $user_info['education_info']    = $education_info->toArray();
                    }

                    $experience_info                    = Experience::find($personal_info_id);
                    if (!empty($experience_info)) {
                        $user_info['experience_info']   = $experience_info->toArray();
                    }

                    $project_info                       = Projects::find($personal_info_id);
                    if (!empty($project_info)) {
                        $user_info['project_info']      = $project_info->toArray();
                    }

                    $skill_info                         = Skills::find($personal_info_id);
                    if (!empty($skill_info)) {
                        $user_info['skill_info']        = $skill_info->toArray();
                    }

                    $language_info                      = Languages::find($personal_info_id);
                    if (!empty($language_info)) {
                        $user_info['language_info']     = $language_info->toArray();
                    }

                    $interest_info                      = Interests::find($personal_info_id);
                    if (!empty($interest_info)) {
                        $user_info['interest_info']     = $interest_info->toArray();
                    }
                }

                array_push($user_data, $user_info);
            }
        } else {
            $user_data = array();
        }

        return view('home', ['users_data' => $user_data]);
    }



    public function view($id)
    {
        if (!empty($id)) {
            $personal_information       = PersonalInformation::find($id)->toArray();
            $contact_information        = ContactInformation::where('personal_information_id', $id)->get()->first()->toArray();
            $education_information      = Education::where('personal_information_id', $id)->get()->toArray();
            $experience_information     = Experience::where('personal_information_id', $id)->get()->toArray();
            $project_information        = Projects::where('personal_information_id', $id)->get()->toArray();
            $skill_information          = Skills::where('personal_information_id', $id)->get()->toArray();
            $language_information       = Languages::where('personal_information_id', $id)->get()->toArray();
            $interest_information       = Interests::where('personal_information_id', $id)->get()->toArray();

            $info['personal_info']      = $personal_information;
            $info['contact_info']       = $contact_information;
            $info['education_info']     = $education_information;
            $info['experience_info']    = $experience_information;
            $info['project_info']       = $project_information;
            $info['skill_info']         = $skill_information;
            $info['language_info']      = $language_information;
            $info['interest_info']      = $interest_information;
        }

        return view('admin.view', ['information' => $info]);
    }
}
