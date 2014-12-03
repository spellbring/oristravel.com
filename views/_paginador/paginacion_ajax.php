<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

if(isset($this->_paginacion))
{
?>

<center>
    <div class="tab-pane active" id="dompaginate">
        <ul class="pagination">
<?php
    if($this->_paginacion['primero'])
    { ?>
        <li><a href="<?php echo $link . $this->_paginacion['primero']; ?>">&ll;</a></li>
    <?php 
    }else{ ?>
        <li class="disabled"><a href="#">&ll;</a></li>
<?php } ?>

        
   
    
    
<?php 
    if($this->_paginacion['anterior'])
    { ?>
        <li><a href="<?php echo $link . $this->_paginacion['anterior']; ?>">&lt;</a></li>
    <?php 
    }else{ ?>
        <li class="disabled"><a href="#">&lt;</a></li>
<?php } ?>
    
    
    
    
    
<?php 
    for($i=0; $i < count($this->_paginacion['rango']); $i++)
    { 
        if($this->_paginacion['actual'] == $this->_paginacion['rango'][$i])
        { 
        ?>
            <li class="active"><a href="#"><?php echo $this->_paginacion['rango'][$i]; ?></a></li> 
        <?php }else{ ?>
            <li><a href="<?php echo $link . $this->_paginacion['rango'][$i]; ?>"><?php echo $this->_paginacion['rango'][$i]; ?></a></li>
    <?php 
        }
    } 
?>
            
            
    
    
    
<?php 
    if($this->_paginacion['siguiente'])
    { ?>
        <li><a href="<?php echo $link . $this->_paginacion['siguiente']; ?>">&gt;</a></li>
    <?php 
    }else{ ?>
        <li class="disabled"><a href="#">&gt;</a></li>
<?php } ?>    

    
    
    
    
<?php 
    if($this->_paginacion['ultimo'])
    { ?>
        <li><a href="<?php echo $link . $this->_paginacion['ultimo']; ?>">&gg;</a></li>
<?php 
    }else{ ?>
        <li class="disabled"><a href="#">&gg;</a></li>
<?php } ?>

        </ul>
    </div>
</center>

<?php } ?>      
