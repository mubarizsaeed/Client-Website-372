<?php
/**
 * Class representing an ImageBox on the art gallery website
 */
class ImageBox {
    // Properties to store image box details
    private $name;
    private $imagePath;
    private $alt;
    private $soundId;

    /**
     * Constructor to initialize an ImageBox object
     * @param string $name The name of the image box
     * @param string $imagePath The file path to the image
     * @param string $alt The alternative text for the image
     * @param string $soundId The ID of the associated sound
     */
    public function __construct($name, $imagePath, $alt, $soundId) {
        $this->name = $name;
        $this->imagePath = $imagePath;
        $this->alt = $alt;
        $this->soundId = $soundId;
    }

    /**
     * Displays the image box with its image, sound button, and associated data attributes
     */
    public function displayImageBox() {
        echo "<div class='image-box' data-name='$this->name' data-sound-id='$this->soundId'>";
        echo "<img src='$this->imagePath' alt='$this->alt'>";
        echo "<h6></h6>";
        echo "<button class='sound-btn'>Play Sound</button>";
        echo "</div>";
    }
}

// Create instances of the ImageBox class
$imageBox1 = new ImageBox(
    "clouds",
    "images/clouds_1.webp",
    "clouds",
    "727486"
);

$imageBox2 = new ImageBox(
    "eye",
    "images/eye.webp",
    "eye",
    "726464"
);

$imageBox3 = new ImageBox(
    "flowers2",
    "images/flowers2.webp",
    "Flowers",
    "269221"
);

$imageBox4 = new ImageBox(
    "flowers",
    "images/flowers.webp",
    "Flowers",
    "653067"
);

$imageBox5 = new ImageBox(
    "italy",
    "images/italy.webp",
    "italy",
    "592926"
);

// Display the image boxes

?>