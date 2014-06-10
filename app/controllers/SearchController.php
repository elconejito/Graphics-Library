<?php
use Graphics\Transformers\TagToJson;

class SearchController extends \BaseController {
    
    /*
     * @var Graphics\Transformers\TagToJson
     */
    protected $tagToJson;
    
    function __construct(TagToJson $tagToJson) {
        $this->tagToJson = $tagToJson;
    }

	/**
	 * Display a listing of the resource.
	 * GET /search
	 *
	 * @return Response
	 */
	public function index($type='all', $format='html')
	{
		// grab the request
		$query = Request::get('q');
    
        // for the moment, just returning tags
        switch ( $type ) {
            case 'projects':
                break;
            case 'agencies':
                break;
            case 'tags':
                $results = Tag::search($query)->get();
                break;
            case 'graphics':
                break;
            case 'all':
            default:
                $projects = Project::search($query)->get();
                $agencies = Agency::search($query)->get();
                $tags = Tag::search($query)->get();
                $graphics = Graphic::search($query)->get();
                
                // force html to return for now
                $format = 'html';
                break;
        }
        
        if ( $format == 'json' ) {
            $arJSON = array();
            return Response::json($this->tagToJson->transformCollection($results->toArray()));
        } else {
            if ( $type == 'all' )
                return View::make('search', compact('projects','agencies','tags','graphics','query'));
            else
                return 'single search type here';
        }
	}

}