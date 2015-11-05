<?php

require_once 'AppConfig.php';

/**
 * Facebook Invite Condensed control is used to send the invite requests to the user's friends,
 * to use Facebook application or Facebook Connect website.
 */
class InviteFriendsCondensed
{
    /**
     * Function sets the URL where application should be redirected, after an invitation is sent.
     * Default is application Canvas URL taken from AppConfig class
     * @param <string> $actionUrl
     */
    public function SetActionUrl($actionUrl) {$this->actionUrl = $actionUrl;}

    /**
     * Function sets the URL where user will be redirected after the invite request is accepted. 
	 * If it's not set, ActionUrl is used.
     * @param <string> $acceptUrl
     */
    public function SetAcceptUrl($acceptUrl) {$this->acceptUrl = $acceptUrl;}

    /**
     * Function sets the description which should be displayed on the invite request.
     * @param <string> $content
     */
    public function SetContent($content) {$this->content = $content;}
    
    /**
     * Function sets the width of the control selector in pixels.
     * @param <type> $width
     */
    public function SetSelectorWidth($selectorWidth) 
	{
        if (! is_int($selectorWidth))
        {
            throw new Exception("Invite Friends Error:  Width parameter is not an integer type.");
        }
        $this->selectorWidth = $selectorWidth;
    }

    /**
     * Function sets the number of unselected rows to be displayed. 
     * Allowed values are from 4 to 15. Default value is 6.
     * @param <int> $unselectedRowsCount
     */
    public function SetUnselectedRowsCount($unselectedRowsCount) 
    {
        if (! is_int($unselectedRowsCount))
        {
            throw new Exception("Invite Friends Error:  UnselectedRowsCount parameter is not an integer type.");
        }
        $this->unselectedRows = $unselectedRowsCount;
    }

    /**
     * Function sets the number of selected rows to be displayed. 
     * Allowed values are from 5 to 15. Default value is 5.
     * @param <int> $selectedRowsCount
     */
    public function SetSelectedRowsCount($selectedRowsCount) 
    {
        if (! is_int($selectedRowsCount))
        {
            throw new Exception("Invite Friends Error:  SelectedRowsCount parameter is not an integer type.");
        }
        $this->selectedRows = $selectedRowsCount;
    }
        
    /**
     * Function sets the comma separated list of friends which should not be displayed in the invite control.
     * @param <int> $excludeFriends
     */
    public function SetExcludeFriends($excludeFriends) {$this->excludeFriends = $excludeFriends; }
        
    /**
     * Function sets the name of application. Default is name set in AppConfig class
     * @param <string> $appName
     */
    public function SetAppName($appName) {$this->appName = $appName;}

    /**
     * Function sets the text of the confirm button. Default value is 'Accept'.
     * @param <string> $confirmButtonText
     */
    public function SetConfirmButtonText($confirmButtonText) {$this->confirmButtonText = $confirmButtonText;}

    /**
     * Function sets the CSS style.
     * @param <string> $cssStyle
     */
    public function SetCssStyle($cssStyle) {$this->cssStyle = $cssStyle;}

    /**
     * Function sets the CSS class.
     * @param <string> $cssClass
     */
    public function SetCssClass($cssClass) {$this->cssClass = $cssClass;}

    /**
     * Function sets the width of the control in pixels. Default value is 760.
     * @param <type> $width
     */
    public function SetWidth($width) 
	{
        if (! is_int($width))
        {
            throw new Exception("Invite Friends Error:  Width parameter is not an integer type.");
        }
        $this->width = $width;
    }



    /**
    * Get html for creating of this component, depending on defined settings.
    * @return string html
    */
    public function GetOutputHtml()
    {
        // check consistency
        if ($this->content == null)
        {
            throw new Exception('Invite Friends Error:  Content is not set.');
        }
        if ($this->confirmButtonText == null)
        {
            throw new Exception('Invite Friends Error:  Confirm Button Title is not set.');
        }

        // set defaults
        if ($this->actionUrl == null)
        {
           $this->actionUrl = AppConfig::GetAppCanvasUrl();
        }
        if ($this->acceptUrl == null)
        {
            $this->acceptUrl = $this->actionUrl;
        }
         if ($this->appName == null)
        {
            $this->appName = AppConfig::GetAppName();
        }

        $html = "<div style='" . $this->cssStyle . "' class='" . $this->cssClass .  "' >\n";
        $html .= "<fb:serverfbml ";
        if ($this->width != null)
        {
            $html .= "width='" . $this->width . "' ";
        }
        $html .= ">\n";
        $html .= "<script type='text/fbml'>";
        $html .= "<div style='" . $this->cssStyle . "' class='" . $this->cssClass .  "' >\n";
        $html .= "<fb:fbml>";
        $html .= "<fb:request-form  method=\"GET\" target=\"_top\" action=\"";
        $html .= $this->actionUrl;
        $html .= "\" content=\"";
        $html .= $this->content;
        $html .= "<fb:req-choice url='";
        $html .= $this->acceptUrl;
        $html .= "' label='";
        $html .= $this->confirmButtonText;
        $html .= "' />\" type=\"";
        $html .= $this->appName;
        $html .= "\" invite=\"true\">";
        $html .= "<fb:multi-friend-selector condensed=\"true\" exclude_ids=\"";
        $html .= $this->excludeFriends;
        $html .= "\" style=\"width:";
        $html .= $this->selectorWidth;
        $html .= "px\" unselected_rows=\"";
        $html .= $this->unselectedRows;
        $html .= "\" selected_rows=\"";
        $html .= $this->selectedRows;
        $html .= "\"  />";
        $html .= "<fb:request-form-submit />";
        $html .= "</fb:request-form> ";
        $html .= "</fb:fbml>";
        $html .= "</div>";
        $html .= "</script>";
        $html .= "</fb:serverfbml>";
        $html .= "</div>";
        return $html;
    }

    /**
     * Function renders component on the web page, depending on defined settings.
     */
    public function Render()
    {
        echo $this->GetOutputHtml();
    }


    // Private members
    private $excludeFriends = "";
    private $selectorWidth = 300;
    private $unselectedRows = 6;
    private $selectedRows = 5;
    private $actionUrl = null;
    private $acceptUrl = null;
    private $content = null;
    private $confirmButtonText = "Accept";
    private $appName = null;
    private $cssStyle = null;
    private $cssClass = null;
    private $width = 760;
}
?>
