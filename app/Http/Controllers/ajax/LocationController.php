<?php

namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\authRequest;
use App\Repositories\DistrictRepository;
use App\Repositories\ProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    protected $DistrictRepository;
    protected $ProvinceRepository;

    public function __construct(
        DistrictRepository $DistrictRepository,
        ProvinceRepository $ProvinceRepository
    ) {
        $this->DistrictRepository = $DistrictRepository;
        $this->ProvinceRepository = $ProvinceRepository;
    }

    public function getLocation(Request $request)
    {
        $input = $request->all();
        $html = '';
        if ($input['target'] == 'district') {
            $provinces = $this->ProvinceRepository->findByCode(['code', 'name'], ['district'], 'code', $input['data']['location_code']);
            $html = $this->renderHTML($provinces->district, $input['target']);
        } else if ($input['target'] == 'ward') {
            $districts =  $this->DistrictRepository->findByCode(['code', 'name'], ['ward'], 'code', $input['data']['location_code']);
            $html = $this->renderHTML($districts->ward, $input['target']);
        };

        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }

    public function renderHTML($locals, $target)
    {
        if ($target == 'district') {
            $html = '<option value = "0" >[Chọn Quận/Huyện]</option>';
        }
        else if ($target == 'ward') {
            $html = '<option value = "0" >[Chọn Phường/Xã]</option>';
        }

        foreach ($locals as $local) {
            $html .= '<option value = "' . $local['code'] . '" >' . $local['full_name'] . '</option>';
        }

        return $html;
    }
}
