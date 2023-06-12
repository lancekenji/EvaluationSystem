<?php
class IJDynamic
{
    private $questionModel, $categoryModel;

    public function __construct()
    {
        $this->questionModel = new QuestionModel();
        $this->categoryModel = new CategoryModel();
    }

    public function generateQuestions()
    {
        $html = '';
        $option = [
            ['label' => '5 - Excellent', 'value' => 5],
            ['label' => '4 - Very Satisfactory', 'value' => 4],
            ['label' => '3 - Satisfactory', 'value' => 3],
            ['label' => '2 - Fair', 'value' => 2],
            ['label' => '1 - Poor', 'value' => 1],
        ];
        foreach($this->categoryModel->getAllCategory() as $category)
        {
            $html .= '<h3>'.$category['category_name'].'</h3>';
            $q_counter = 1;
            foreach ($this->questionModel->getAllQuestionByCategoryId($category['category_id']) as $question)
            {
                $html .= '<p>'. $q_counter. '. ' . $question['question_text'] . '</p>';
    
                foreach($option as $o)
                {
                    $html .= '<input class="form-check-input" type="radio" name="q' . $question['question_id'] . '" value="' . $o['value'] . '"> &nbsp;&nbsp;' . $o['label'] . '<br>';
                }
    
                $html .= '<br>';
                $q_counter++;
            }

            $html .= '<hr>';
        }
        
        return $html;
    }
}
?>