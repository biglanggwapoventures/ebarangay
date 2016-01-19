<?php
class Items extends EB_Controller {

    protected $tab_title = 'Items';
    protected $active_nav = NAV_ITEMS;
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Item_model', 'item');
    }

    function index() {
        $this->generate_page('items/listing', [
            'items' => $this->item->all()
        ]);
    }

    function create() {
        $this->import_page_script('manage-items.js');
        $this->generate_page('items/manage', [
            'title' => 'Create new item',
            'mode' => MODE_CREATE,
            'data' => []
        ]);
    }

    public function edit($id = FALSE)
    {
        if(!$id || !$item = $this->item->get($id)){
            show_404();
        }
        $this->import_page_script('manage-items.js');
        $this->generate_page('items/manage', [
            'title' => 'Create new item',
            'mode' => MODE_EDIT,
            'data' => $item
        ]);
    }

    public function store()
    {
        $this->output->set_content_type('json');
        $this->_perform_validation(MODE_CREATE);
        if($this->form_validation->run()){
            $item = $this->_format_data(MODE_CREATE);
            $this->item->create($item);
            $this->output->set_output(json_encode(['result' => TRUE]));
            return;
        }
        $this->output->set_output(json_encode([
            'result' => FALSE,
            'errors' => array_values($this->form_validation->error_array())
        ]));
    }

    public function update($id = FALSE)
    {
        $this->output->set_content_type('json');
        if(!$id || !$this->item->exists($id)){
            $this->output->set_output(json_encode([
                'result' => FALSE,
                'errors' => 'Please select a valid item to update.'
            ]));
            return;
        }
        $this->id = $id;
        $this->_perform_validation(MODE_EDIT);
        if($this->form_validation->run()){
            $item = $this->_format_data(MODE_EDIT);
            $this->item->update($id, $item);
            $this->output->set_output(json_encode(['result' => TRUE]));
            return;
        }
        $this->output->set_output(json_encode([
            'result' => FALSE,
            'errors' => array_values($this->form_validation->error_array())
        ]));
    }

    public function _perform_validation($mode)
    {
        if($mode === MODE_CREATE){
            $this->form_validation->set_rules('name', 'item name', 'required|is_unique[item.name]');
        }else{
            $this->form_validation->set_rules('name', 'item name', 'required|callback__validate_item_name');
        }
        $this->form_validation->set_rules('class', 'item class', 'required|in_list[c,uc]', ['in_list' => 'Please select a valid %s']);
        $this->form_validation->set_rules('acquisition_method', 'item acquisition method', 'required|in_list[b,d]', ['in_list' => 'Please select a valid %s']);
        $this->form_validation->set_rules('acquisition_state', 'item acquisition state', 'required|in_list[o,n]', ['in_list' => 'Please select a valid %s']);
    }

    public function _format_data($mode)
    {
        $input = elements(['name', 'class', 'acquisition_method', 'acquisition_state', 'estimated_cost', 'beginning_quantity', 'details', 'is_disposed'], $this->input->post(), NULL);
        if($mode === MODE_CREATE){
            $input['created_by'] = user_id();
            unset($input['is_disposed']);
        }
        return $input;
    }

    public function _validate_item_name($item_name)
    {
        $this->form_validation->set_message('_validate_item_name', 'The %s is already in use.');
        return $this->item->has_unique_name($item_name, $this->id);
    }
}
