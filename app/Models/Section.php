<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Types\Self_;
use App\Traits\Files\HasFile;

class Section extends Model
{
    use HasFactory, HasFile;
    protected $table = 'sections';
    public $timestamps = true;
    protected $fillable = array('id','name_en', 'name_ar', 'ref_name', 'section_id', 'reservation_cost_type', 'reservation_cost');
    protected $hidden = ['name_en', 'name_ar', 'reservation_cost_type', 'reservation_cost', 'created_at', 'updated_at'];
    protected $appends = ['name','file_url','ads'];

    //appends attributes start
    public function getNameAttribute()
    {
        if (App::getLocale() == 'ar')
            return $this->name_ar;
        return $this->name_en;
    }
    public function getAdsAttribute()
    {
       $ads = Ad::where('organizationable_type', 'App\\Models\\'.$this->ref_name)->orderBy(
           AdType::select('priority')->whereColumn('ad_types.id', 'ads.ad_type_id'), 'desc')->get();
       return $ads;
    }
    //appends attributes end

    //relationship start
    public function parent()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function sub_sections()
    {
        return $this->hasMany(Self::class);
    }

    public function slider()
    {
        return $this->hasOne('App\Models\Slider');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    //relationship end

    //Scopes start
    public function scopeSearch($query)
    {
        $query->when(request()->search, function ($q) {
            return $q->where('ref_name', 'like', '%' . request()->search . '%')
                ->Orwherehas('sub_sections', function (Builder $query) {
                    return $query->where('ref_name', 'like', '%' . request()->search . '%');
                });
        });
    }
    //Scopes end

    // accessors & Mutator start
    public function getSubSection(){
        $sections = Section::all();
        foreach ($sections as  $section) {
            if ($section->section_id != null)
            {
                $parent_name = $section->parent->name;
            }

        }
        return $parent_name;
    }
    // accessors & Mutator ens
}
