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

class Userprofile extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $personal_information   = PersonalInformation::get()->toArray();

=======
        $user = auth()->id();
        $personal_information = PersonalInformation::where('user_id', $user)->get()->toArray();
>>>>>>> test2025
        if (!empty($personal_information)) {

            $user_data = array();
            foreach ($personal_information as $personal_info) {

<<<<<<< HEAD
                $user_id = $personal_info['id'];

                if (!empty($user_id)) {
                    $user_info['personal_info']         = $personal_info;


                    $contact_info                       = ContactInformation::find($user_id);
=======
                $personal_info_id = $personal_info['id'];

                if (!empty($personal_info_id)) {
                    $user_info['personal_info']         = $personal_info;


                    $contact_info                       = ContactInformation::find($personal_info_id);
>>>>>>> test2025
                    if (!empty($contact_info)) {

                        $user_info['contact_info']      = $contact_info->toArray();
                    }

<<<<<<< HEAD
                    $education_info                     = Education::find($user_id);
=======
                    $education_info                     = Education::find($personal_info_id);
>>>>>>> test2025
                    if (!empty($education_info)) {
                        $user_info['education_info']    = $education_info->toArray();
                    }

<<<<<<< HEAD
                    $experience_info                    = Experience::find($user_id);
=======
                    $experience_info                    = Experience::find($personal_info_id);
>>>>>>> test2025
                    if (!empty($experience_info)) {
                        $user_info['experience_info']   = $experience_info->toArray();
                    }

<<<<<<< HEAD
                    $project_info                       = Projects::find($user_id);
=======
                    $project_info                       = Projects::find($personal_info_id);
>>>>>>> test2025
                    if (!empty($project_info)) {
                        $user_info['project_info']      = $project_info->toArray();
                    }

<<<<<<< HEAD
                    $skill_info                         = Skills::find($user_id);
=======
                    $skill_info                         = Skills::find($personal_info_id);
>>>>>>> test2025
                    if (!empty($skill_info)) {
                        $user_info['skill_info']        = $skill_info->toArray();
                    }

<<<<<<< HEAD
                    $language_info                      = Languages::find($user_id);
=======
                    $language_info                      = Languages::find($personal_info_id);
>>>>>>> test2025
                    if (!empty($language_info)) {
                        $user_info['language_info']     = $language_info->toArray();
                    }

<<<<<<< HEAD
                    $interest_info                      = Interests::find($user_id);
=======
                    $interest_info                      = Interests::find($personal_info_id);
>>>>>>> test2025
                    if (!empty($interest_info)) {
                        $user_info['interest_info']     = $interest_info->toArray();
                    }
                }

                array_push($user_data, $user_info);
            }
        } else {
            $user_data = array();
        }

        return view('index', ['users_data' => $user_data]);
    }

<<<<<<< HEAD
    public function view($id)
    {
        if (!empty($id)) {
            $personal_information       = PersonalInformation::find($id)->toArray();
            $contact_information        = ContactInformation::where('user_id', $id)->get()->first()->toArray();
            $education_information      = Education::where('user_id', $id)->get()->toArray();
            $experience_information     = Experience::where('user_id', $id)->get()->toArray();
            $project_information        = Projects::where('user_id', $id)->get()->toArray();
            $skill_information          = Skills::where('user_id', $id)->get()->toArray();
            $language_information       = Languages::where('user_id', $id)->get()->toArray();
            $interest_information       = Interests::where('user_id', $id)->get()->toArray();
=======
    public function view($id, $user_id)
    {
        $user = auth()->id();


        if ($user != $user_id) {
            return redirect()->route('index')->with('error', 'You are not authorized to view this profile.');
        }

        // Check if the personal information ID matches the provided ID
        $personal_info = PersonalInformation::find($id);

        if (!$personal_info || $personal_info->user_id != $user_id) {
            return redirect()->route('index')->with('error', 'You are not authorized to view this profile.');
        }

        if (!empty($id)) {
            $personal_information       = PersonalInformation::find($id)->toArray();
            $contact_information        = ContactInformation::where('personal_information_id', $id)->get()->first()->toArray();
            $education_information      = Education::where('personal_information_id', $id)->get()->toArray();
            $experience_information     = Experience::where('personal_information_id', $id)->get()->toArray();
            $project_information        = Projects::where('personal_information_id', $id)->get()->toArray();
            $skill_information          = Skills::where('personal_information_id', $id)->get()->toArray();
            $language_information       = Languages::where('personal_information_id', $id)->get()->toArray();
            $interest_information       = Interests::where('personal_information_id', $id)->get()->toArray();
>>>>>>> test2025

            $info['personal_info']      = $personal_information;
            $info['contact_info']       = $contact_information;
            $info['education_info']     = $education_information;
            $info['experience_info']    = $experience_information;
            $info['project_info']       = $project_information;
            $info['skill_info']         = $skill_information;
            $info['language_info']      = $language_information;
            $info['interest_info']      = $interest_information;
        }

        return view('view', ['information' => $info]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        $personal_info = new PersonalInformation();
=======
        //auth
        $user = auth()->id();

        $personal_info = new PersonalInformation();
        $personal_info->user_id           = $user;
>>>>>>> test2025
        $personal_info->first_name        = $request->first_name;
        $personal_info->last_name         = $request->last_name;
        $personal_info->profile_title     = $request->profile_title;
        $personal_info->about_me          = $request->about_me;
        if ($request->file('image_path')) {
            $picture       = !empty($request->file('image_path')) ? $request->file('image_path')->getClientOriginalName() : '';
            $request->file('image_path')->move(public_path('assets/images/'), $picture);
        }
        $personal_info->image_path        = isset($picture) && !empty($picture) ? $picture : '';
        $personal_info->save();

        $personal_information = PersonalInformation::latest()->first();

        $contact_info = new ContactInformation();
<<<<<<< HEAD
        $contact_info->user_id          = $personal_information->id;
=======
        $contact_info->user_id          = $user;
>>>>>>> test2025
        $contact_info->email            = $request->email;
        $contact_info->phone_number     = $request->phone_number;
        $contact_info->website          = $request->website;
        $contact_info->linkedin_link    = $request->linkedin_link;
        $contact_info->github_link      = $request->github_link;
        $contact_info->twitter          = $request->twitter;
<<<<<<< HEAD
=======

        $contact_info->personal_information_id = $personal_information->id;

>>>>>>> test2025
        $contact_info->save();


        $edu_count = count($request->degree_title);
        if ($edu_count != 0) {
            for ($i = 0; $i < $edu_count; $i++) {

                $education_info = new Education();
<<<<<<< HEAD
                $education_info->user_id                = $personal_information->id;
=======
                $education_info->user_id                = $user;
>>>>>>> test2025
                $education_info->degree_title           = $request->degree_title[$i];
                $education_info->institute              = $request->institute[$i];
                $education_info->edu_start_date         = $request->edu_start_date[$i];
                $education_info->edu_end_date           = $request->edu_end_date[$i];
                $education_info->education_description  = $request->education_description[$i];
<<<<<<< HEAD
=======

                $education_info->personal_information_id = $personal_information->id;

>>>>>>> test2025
                $education_info->save();
            }
        }


        $exp_count = count($request->job_title);
        if ($exp_count != 0) {
            for ($i = 0; $i < $exp_count; $i++) {

                $experience_info = new Experience();
<<<<<<< HEAD
                $experience_info->user_id          = $personal_information->id;
=======
                $experience_info->user_id          = $user;
>>>>>>> test2025
                $experience_info->job_title        = $request->job_title[$i];
                $experience_info->organization     = $request->organization[$i];
                $experience_info->job_start_date   = $request->job_start_date[$i];
                $experience_info->job_end_date     = $request->job_end_date[$i];
                $experience_info->job_description  = $request->job_description[$i];
<<<<<<< HEAD
=======

                $experience_info->personal_information_id = $personal_information->id;

>>>>>>> test2025
                $experience_info->save();
            }
        }

        $project_count = count($request->project_title);
        if ($project_count != 0) {
            for ($i = 0; $i < $project_count; $i++) {

                $project_info = new Projects();
<<<<<<< HEAD
                $project_info->user_id              = $personal_information->id;
                $project_info->project_title        = $request->project_title[$i];
                $project_info->project_description  = $request->project_description[$i];
=======
                $project_info->user_id              = $user;
                $project_info->project_title        = $request->project_title[$i];
                $project_info->project_description  = $request->project_description[$i];

                $project_info->personal_information_id = $personal_information->id;

>>>>>>> test2025
                $project_info->save();
            }
        }

        $skill_count = count($request->skill_name);
        if ($skill_count != 0) {
            for ($i = 0; $i < $skill_count; $i++) {

                $skill_info = new Skills();
<<<<<<< HEAD
                $skill_info->user_id           = $personal_information->id;
                $skill_info->skill_name        = $request->skill_name[$i];
                $skill_info->skill_percentage  = $request->skill_percentage[$i];
=======
                $skill_info->user_id           = $user;
                $skill_info->skill_name        = $request->skill_name[$i];
                $skill_info->skill_percentage  = $request->skill_percentage[$i];

                $skill_info->personal_information_id = $personal_information->id;

>>>>>>> test2025
                $skill_info->save();
            }
        }

        $lang_count = count($request->language);
        if ($lang_count != 0) {
            for ($i = 0; $i < $lang_count; $i++) {

                $language_info = new Languages();
<<<<<<< HEAD
                $language_info->user_id         = $personal_information->id;
                $language_info->language        = $request->language[$i];
                $language_info->language_level  = $request->language_level[$i];
=======
                $language_info->user_id         = $user;
                $language_info->language        = $request->language[$i];
                $language_info->language_level  = $request->language_level[$i];

                $language_info->personal_information_id = $personal_information->id;

>>>>>>> test2025
                $language_info->save();
            }
        }

        $interest_count = count($request->interest);
        if ($interest_count != 0) {
            for ($i = 0; $i < $interest_count; $i++) {

                $interest_info = new Interests();
<<<<<<< HEAD
                $interest_info->user_id         = $personal_information->id;
                $interest_info->interest        = $request->interest[$i];
=======
                $interest_info->user_id         =  $user;
                $interest_info->interest        = $request->interest[$i];
                $interest_info->personal_information_id = $personal_information->id;

>>>>>>> test2025
                $interest_info->save();
            }
        }

        return redirect()->route('index')->withSuccess("User Profile created successfully");
    }

<<<<<<< HEAD
    public function edit($id)
    {
        if (!empty($id)) {
            $personal_information       = PersonalInformation::find($id)->toArray();
            $contact_information        = ContactInformation::where('user_id', $id)->get()->toArray();
            $education_information      = Education::where('user_id', $id)->get()->toArray();
            $experience_information     = Experience::where('user_id', $id)->get()->toArray();
            $project_information        = Projects::where('user_id', $id)->get()->toArray();
            $skill_information          = Skills::where('user_id', $id)->get()->toArray();
            $language_information       = Languages::where('user_id', $id)->get()->toArray();
            $interest_information       = Interests::where('user_id', $id)->get()->toArray();
=======
    public function edit($id, $user_id)
    {
        $user = auth()->id();


        if ($user != $user_id) {
            return redirect()->route('index')->with('error', 'You are not authorized to view this profile.');
        }

        $personal_id = PersonalInformation::find($id);

        if ($personal_id->user_id != $user_id) {
            return redirect()->route('index')->with('error', 'You are not authorized to view this profile.');
        }

        if (!empty($id)) {
            $personal_information       = PersonalInformation::find($id)->toArray();
            $contact_information        = ContactInformation::where('personal_information_id', $id)->get()->toArray();
            $education_information      = Education::where('personal_information_id', $id)->get()->toArray();
            $experience_information     = Experience::where('personal_information_id', $id)->get()->toArray();
            $project_information        = Projects::where('personal_information_id', $id)->get()->toArray();
            $skill_information          = Skills::where('personal_information_id', $id)->get()->toArray();
            $language_information       = Languages::where('personal_information_id', $id)->get()->toArray();
            $interest_information       = Interests::where('personal_information_id', $id)->get()->toArray();
>>>>>>> test2025

            $info['personal_info']      = $personal_information;
            $info['contact_info']       = $contact_information;
            $info['education_info']     = $education_information;
            $info['experience_info']    = $experience_information;
            $info['project_info']       = $project_information;
            $info['skill_info']         = $skill_information;
            $info['language_info']      = $language_information;
            $info['interest_info']      = $interest_information;

            return view('edit', ['information' => $info]);
        } else {
            return redirect()->back()->withErrors('Somthing went wrong');
        }
    }

    public function update(Request $request)
    {

        if ($request->verify == 1) {
<<<<<<< HEAD
            $id = $request->user_id;
=======
            $id = $request->personal_information_id;
>>>>>>> test2025

            $personal_info = PersonalInformation::find($id);
            $personal_info->first_name        = $request->first_name;
            $personal_info->last_name         = $request->last_name;
            $personal_info->profile_title     = $request->profile_title;
            $personal_info->about_me          = $request->about_me;
            if ($request->file('image_path')) {
                $picture       = !empty($request->file('image_path')) ? $request->file('image_path')->getClientOriginalName() : '';
                $request->file('image_path')->move(public_path('assets/images/'), $picture);
            }
            if (!empty($request->file('image_path'))) {
                $personal_info->image_path        = isset($picture) && !empty($picture) ? $picture : '';
            }
            $personal_info->save();

<<<<<<< HEAD
            $contact_info = ContactInformation::where('user_id', $id)->get()->first();
            $contact_info->user_id          = $id;
=======
            $contact_info = ContactInformation::where('personal_information_id', $id)->get()->first();
            $contact_info->personal_information_id          = $id;
>>>>>>> test2025
            $contact_info->email            = $request->email;
            $contact_info->phone_number     = $request->phone_number;
            $contact_info->website          = $request->website;
            $contact_info->linkedin_link    = $request->linkedin_link;
            $contact_info->github_link      = $request->github_link;
            $contact_info->twitter          = $request->twitter;
            $contact_info->save();


<<<<<<< HEAD
            $education_info     = Education::where('user_id', $id)->get();
=======
            $education_info     = Education::where('personal_information_id', $id)->get();
>>>>>>> test2025
            $edu_count_local    = !empty($request->degree_title) ? count($request->degree_title) : 0;
            $edu_count_live     = count($education_info);

            $edu_count_live >= $edu_count_local ? $edu_count = $edu_count_live : $edu_count = $edu_count_local;

            if ($edu_count != 0) {
                for ($i = 0; $i < $edu_count; $i++) {

                    if ($edu_count_local > 0 && $edu_count_live <= 0) {

                        $edu_info = new Education();
<<<<<<< HEAD
                        $edu_info->user_id                = $id;
=======
                        $edu_info->personal_information_id                = $id;
>>>>>>> test2025
                        $edu_info->degree_title           = $request->degree_title[$i];
                        $edu_info->institute              = $request->institute[$i];
                        $edu_info->edu_start_date         = $request->edu_start_date[$i];
                        $edu_info->edu_end_date           = $request->edu_end_date[$i];
                        $edu_info->education_description  = $request->education_description[$i];
                        $edu_info->save();
                    } elseif ($edu_count_live > 0 && $edu_count_local <= 0) {

                        Education::find($education_info[$i]['id'])->delete();
                    } else {

<<<<<<< HEAD
                        $education_info[$i]->user_id                = $id;
=======
                        $education_info[$i]->personal_information_id                = $id;
>>>>>>> test2025
                        $education_info[$i]->degree_title           = $request->degree_title[$i];
                        $education_info[$i]->institute              = $request->institute[$i];
                        $education_info[$i]->edu_start_date         = $request->edu_start_date[$i];
                        $education_info[$i]->edu_end_date           = $request->edu_end_date[$i];
                        $education_info[$i]->education_description  = $request->education_description[$i];
                        $education_info[$i]->save();
                    }

                    $edu_count_local--;
                    $edu_count_live--;
                }
            }



<<<<<<< HEAD
            $experience_info    = Experience::where('user_id', $id)->get();
=======
            $experience_info    = Experience::where('personal_information_id', $id)->get();
>>>>>>> test2025
            $exp_count_local    = !empty($request->job_title) ? count($request->job_title) : 0;
            $exp_count_live     = count($experience_info);

            $exp_count_live >= $exp_count_local ? $exp_count = $exp_count_live : $exp_count = $exp_count_local;

            if ($exp_count != 0) {
                for ($i = 0; $i < $exp_count; $i++) {

                    if ($exp_count_local > 0 && $exp_count_live <= 0) {

                        $exp_info = new Experience();
<<<<<<< HEAD
                        $exp_info->user_id          = $id;
=======
                        $exp_info->personal_information_id          = $id;
>>>>>>> test2025
                        $exp_info->job_title        = $request->job_title[$i];
                        $exp_info->organization     = $request->organization[$i];
                        $exp_info->job_start_date   = $request->job_start_date[$i];
                        $exp_info->job_end_date     = $request->job_end_date[$i];
                        $exp_info->job_description  = $request->job_description[$i];
                        $exp_info->save();
                    } elseif ($exp_count_live > 0 && $exp_count_local <= 0) {

                        Experience::find($experience_info[$i]['id'])->delete();
                    } else {
<<<<<<< HEAD
                        $experience_info[$i]->user_id          = $id;
=======
                        $experience_info[$i]->personal_information_id          = $id;
>>>>>>> test2025
                        $experience_info[$i]->job_title        = $request->job_title[$i];
                        $experience_info[$i]->organization     = $request->organization[$i];
                        $experience_info[$i]->job_start_date   = $request->job_start_date[$i];
                        $experience_info[$i]->job_end_date     = $request->job_end_date[$i];
                        $experience_info[$i]->job_description  = $request->job_description[$i];
                        $experience_info[$i]->save();
                    }

                    $exp_count_local--;
                    $exp_count_live--;
                }
            }



<<<<<<< HEAD
            $project_info           = Projects::where('user_id', $id)->get();
=======
            $project_info           = Projects::where('personal_information_id', $id)->get();
>>>>>>> test2025
            $project_count_local    = !empty($request->project_title) ? count($request->project_title) : 0;
            $project_count_live     = count($project_info);

            $project_count_live >= $project_count_local ? $project_count = $project_count_live : $project_count = $project_count_local;

            if ($project_count != 0) {
                for ($i = 0; $i < $project_count; $i++) {

                    if ($project_count_local > 0 && $project_count_live <= 0) {

                        $pro_info = new Projects();
<<<<<<< HEAD
                        $pro_info->user_id              = $id;
=======
                        $pro_info->personal_information_id              = $id;
>>>>>>> test2025
                        $pro_info->project_title        = $request->project_title[$i];
                        $pro_info->project_description  = $request->project_description[$i];
                        $pro_info->save();
                    } elseif ($project_count_live > 0 && $project_count_local <= 0) {

                        Projects::find($project_info[$i]['id'])->delete();
                    } else {

<<<<<<< HEAD
                        $project_info[$i]->user_id              = $id;
=======
                        $project_info[$i]->personal_information_id              = $id;
>>>>>>> test2025
                        $project_info[$i]->project_title        = $request->project_title[$i];
                        $project_info[$i]->project_description  = $request->project_description[$i];
                        $project_info[$i]->save();
                    }

                    $project_count_live--;
                    $project_count_local--;
                }
            }


<<<<<<< HEAD
            $skill_info           = Skills::where('user_id', $id)->get();
=======
            $skill_info           = Skills::where('personal_information_id', $id)->get();
>>>>>>> test2025
            $skill_count_local    = !empty($request->skill_name) ? count($request->skill_name) : 0;
            $skill_count_live     = count($skill_info);

            $skill_count_live >= $skill_count_local ? $skill_count = $skill_count_live : $skill_count = $skill_count_local;

            if ($skill_count != 0) {
                for ($i = 0; $i < $skill_count; $i++) {

                    if ($skill_count_local > 0 && $skill_count_live <= 0) {

                        $sk_info = new Skills();
<<<<<<< HEAD
                        $sk_info->user_id           = $id;
=======
                        $sk_info->personal_information_id           = $id;
>>>>>>> test2025
                        $sk_info->skill_name        = $request->skill_name[$i];
                        $sk_info->skill_percentage  = $request->skill_percentage[$i];
                        $sk_info->save();
                    } elseif ($skill_count_live > 0 && $skill_count_local <= 0) {

                        Skills::find($skill_info[$i]['id'])->delete();
                    } else {

<<<<<<< HEAD
                        $skill_info[$i]->user_id           = $id;
=======
                        $skill_info[$i]->personal_information_id           = $id;
>>>>>>> test2025
                        $skill_info[$i]->skill_name        = $request->skill_name[$i];
                        $skill_info[$i]->skill_percentage  = $request->skill_percentage[$i];
                        $skill_info[$i]->save();
                    }

                    $skill_count_live--;
                    $skill_count_local--;
                }
            }



<<<<<<< HEAD
            $language_info          = Languages::where('user_id', $id)->get();
=======
            $language_info          = Languages::where('personal_information_id', $id)->get();
>>>>>>> test2025
            $lang_count_local       = !empty($request->language) ? count($request->language) : 0;
            $lang_count_live        = count($language_info);

            $lang_count_live >= $lang_count_local ? $lang_count = $lang_count_live : $lang_count = $lang_count_local;

            if ($lang_count != 0) {
                for ($i = 0; $i < $lang_count; $i++) {

                    if ($lang_count_local > 0 && $lang_count_live <= 0) {

                        $lang_info = new Languages();
<<<<<<< HEAD
                        $lang_info->user_id         = $id;
=======
                        $lang_info->personal_information_id         = $id;
>>>>>>> test2025
                        $lang_info->language        = $request->language[$i];
                        $lang_info->language_level  = $request->language_level[$i];
                        $lang_info->save();
                    } elseif ($lang_count_live > 0 && $lang_count_local <= 0) {

                        Languages::find($language_info[$i]['id'])->delete();
                    } else {

<<<<<<< HEAD
                        $language_info[$i]->user_id         = $id;
=======
                        $language_info[$i]->personal_information_id         = $id;
>>>>>>> test2025
                        $language_info[$i]->language        = $request->language[$i];
                        $language_info[$i]->language_level  = $request->language_level[$i];
                        $language_info[$i]->save();
                    }

                    $lang_count_live--;
                    $lang_count_local--;
                }
            }


<<<<<<< HEAD
            $interest_info              = Interests::where('user_id', $id)->get();
=======
            $interest_info              = Interests::where('personal_information_id', $id)->get();
>>>>>>> test2025
            $interest_count_local       = !empty($request->interest) ? count($request->interest) : 0;
            $interest_count_live        = count($interest_info);

            $interest_count_live >= $interest_count_local ? $interest_count = $interest_count_live : $interest_count = $interest_count_local;

            if ($interest_count != 0) {
                for ($i = 0; $i < $interest_count; $i++) {

                    if ($interest_count_local > 0 && $interest_count_live <= 0) {

                        $int_info = new Interests();
<<<<<<< HEAD
                        $int_info->user_id         = $id;
=======
                        $int_info->personal_information_id         = $id;
>>>>>>> test2025
                        $int_info->interest        = $request->interest[$i];
                        $int_info->save();
                    } elseif ($interest_count_live > 0 && $interest_count_local <= 0) {

                        Interests::find($interest_info[$i]['id'])->delete();
                    } else {

<<<<<<< HEAD
                        $interest_info[$i]->user_id         = $id;
=======
                        $interest_info[$i]->personal_information_id         = $id;
>>>>>>> test2025
                        $interest_info[$i]->interest        = $request->interest[$i];
                        $interest_info[$i]->save();
                    }

                    $interest_count_live--;
                    $interest_count_local--;
                }
            }
        }

        return redirect()->back()->withSuccess("User Profile updated successfully");
    }

    public function destroy($id)
    {

        if (!empty($id)) {

            PersonalInformation::find($id)->delete();
<<<<<<< HEAD
            ContactInformation::where('user_id', $id)->delete();
            Education::where('user_id', $id)->delete();
            Experience::where('user_id', $id)->delete();
            Projects::where('user_id', $id)->delete();
            Skills::where('user_id', $id)->delete();
            Languages::where('user_id', $id)->delete();
            Interests::where('user_id', $id)->delete();
=======
            ContactInformation::where('personal_information_id', $id)->delete();
            Education::where('personal_information_id', $id)->delete();
            Experience::where('personal_information_id', $id)->delete();
            Projects::where('personal_information_id', $id)->delete();
            Skills::where('personal_information_id', $id)->delete();
            Languages::where('personal_information_id', $id)->delete();
            Interests::where('personal_information_id', $id)->delete();
>>>>>>> test2025

            return redirect()->back()->withSuccess("User Profile deleted successfully");
        } else {

            return redirect()->back()->withSuccess("Something went wrong");
        }
    }
}
