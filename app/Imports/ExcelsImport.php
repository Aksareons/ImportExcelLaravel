<?php

namespace App\Imports;

use Illuminate\Support\Arr;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Validator;

class ExcelsImport implements ToCollection, SkipsOnError, SkipsOnFailure
{
	use Importable, SkipsErrors, SkipsFailures;
	/**
	* @param Collection $collection
	*
	*/

	

		public function collection(Collection $collection)
		{  
			$i = 0;
			$categories = [];
			
			foreach ($collection as $item) {
				if ($i == 0) {$i++;
					}else 
						{
	
						if (isset($item[5]) && ($item[5] != null) && ($item[10] == null)) {
							if ($item[0] == null ){
								if( Category::where('name', ' ')->first()){
									$category_id  = Category::where('name', ' ')->first();
									
								}else {
										$category_id  = new Category() ;
										$category_id->name = ' ';
										$category_id->save();
								}
							}
							
						if (isset($item[0])){
							if (in_array($item[0], $categories) || Category::where('name', $item[0])->first()){
								$category_id = Category::where('name', $item[0])->first();
								
							}else {
								$category_id = new Category() ;
								$category_id->name = $item[0]; 
								$categories[] = $item[0];
								$category_id->save();
							}
						} 
								if (Item::where('article', $item[5])->first()){
									$i++;
								}else {
								$product = new Item();
									
								$product->category_id = $item[0] ? $category_id->id : $category_id->id;
								$product->rubric = $item[1] ? $item[1] : '';
								$product->category = $item[2] ? $item[2] : '';
								$product->manufacturer = $item[3] ? $item[3] : '';
								$product->name = $item[4] ? $item[4] : '';
								$product->article = $item[5] ? $item[5] : '';
								$product->dsc = $item[6] ? $item[6] : '';
								$product->price = $item[7] ? $item[7] : '';
								$product->warranty = $item[8] ? $item[8] : '';
								$product->availability = $item[9] ? $item[9] : '';
									$product->save();
								}
							}
						if (isset($item[6]) && ($item[6] != null) && $item[10] && $item[10] != null) {
							if ($item[1] == null ){
								if( Category::where('name', ' ')->first()){
									$category_id  = Category::where('name', ' ')->first();
								}else {
								$category_id  = new Category() ;
								$category_id->name = ' ';
								$category_id->save();
								}
							}
							
								if (isset($item[1])){
									if (in_array($item[1], $categories) || Category::where('name', $item[1])->first())
									{
									$category_id = Category::where('name', $item[1])->first();
									} else {
								$category_id = new Category() ;
									$category_id->name = $item[1]; 
									$categories[] = $item[1];
										$category_id->save();
									}
									} 
								if (Item::where('article', $item[6])->first()){
									$i++;
								}else {
								$product = new Item();
									
								$product->category_id = $item[1] ? $category_id->id : $category_id->id;
								$product->rubric = $item[2] ? $item[2] : '';
								$product->category = $item[3] ? $item[3] : '';
								$product->manufacturer = $item[4] ? $item[4] : '';
								$product->name = $item[5] ? $item[5] : '';
								$product->article = $item[6] ? $item[6] : '';
								$product->dsc = $item[7] ? $item[7] : '';
								$product->price = $item[8] ? $item[8] : '';
								$product->warranty = $item[9] ? $item[9] : '';
								$product->availability = $item[10] ? $item[10] : '';
									$product->save();
								}
						   }
					}
			}
		   
		}

	 
}
		   
	   